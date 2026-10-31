// Maquette 3D du centre. Rien ne bouge seul : la scène n'est redessinée qu'à l'interaction,
// pour ne pas gêner les personnes sensibles au mouvement et pour économiser la batterie.
import * as THREE from 'three';
import { OrbitControls } from './vendor/three/OrbitControls.js';

const root = document.querySelector('[data-c3d]');
const canvas = root.querySelector('canvas');
const pinsLayer = root.querySelector('[data-c3d-pins]');
const reducedMotion = matchMedia('(prefers-reduced-motion: reduce)').matches;

const COLORS = {
    ground: 0xc9a877, lawn: 0x8fb56b, path: 0xe6d3ae, wall: 0xf6efe2, roof: 0xb4553a,
    wood: 0x7a5234, glass: 0x4f7ea3, tree: 0x4f8a4a, water: 0x6bc0e7, thatch: 0xc9a14f, solar: 0x1f3b63,
};

// Couleur douce de chaque pôle : elle aide à se repérer sans surcharger le regard.
const ZONES = {
    accueil:   { color: 0x6bc0e7, pin: [-13, 7, 13], view: [-13, 0, 13] },
    classes:   { color: 0xf0c75e, pin: [-11, 7, -13], view: [-11, 0, -13] },
    therapies: { color: 0x9dc99a, pin: [10, 7, -13], view: [10, 0, -13] },
    sensoriel: { color: 0xc4b3e6, pin: [-22, 7, 0], view: [-22, 0, 0] },
    ateliers:  { color: 0xeeb07a, pin: [22, 7, 0], view: [22, 0, 0] },
    formation: { color: 0x7fa8d9, pin: [11, 7, 13], view: [11, 0, 13] },
    familles:  { color: 0xeac3a5, pin: [8, 8, 0], view: [8, 0, 0] },
    jardin:    { color: COLORS.lawn, pin: [-5, 4, 0], view: [-4, 0, 0] },
    logement:  { color: 0xe7a6a1, pin: [0, 6, -30], view: [0, 0, -30] },
};

const OVERVIEW = { position: new THREE.Vector3(46, 62, 74), target: new THREE.Vector3(0, 0, -6) };

const material = color => new THREE.MeshStandardMaterial({ color, roughness: 0.85 });

function makeRenderer() {
    try {
        return new THREE.WebGLRenderer({ canvas, antialias: true });
    } catch (e) {
        return null;
    }
}

function box(parent, size, position, color) {
    const mesh = new THREE.Mesh(new THREE.BoxGeometry(...size), material(color));
    mesh.position.set(...position);
    mesh.castShadow = mesh.receiveShadow = true;
    parent.add(mesh);
    return mesh;
}

function cylinder(parent, radiusTop, radiusBottom, height, position, color, segments = 16) {
    const mesh = new THREE.Mesh(new THREE.CylinderGeometry(radiusTop, radiusBottom, height, segments), material(color));
    mesh.position.set(...position);
    mesh.castShadow = mesh.receiveShadow = true;
    parent.add(mesh);
    return mesh;
}

// Toit à deux pentes, prolongé par un débord qui protège les façades du soleil.
function roof(parent, width, depth, x, y, z, alongX) {
    const span = alongX ? depth : width;
    const length = (alongX ? width : depth) + 1.6;
    const half = span / 2 + 0.8;
    const shape = new THREE.Shape();
    shape.moveTo(-half, 0);
    shape.lineTo(half, 0);
    shape.lineTo(0, span * 0.22);
    shape.closePath();

    const geometry = new THREE.ExtrudeGeometry(shape, { depth: length, bevelEnabled: false });
    geometry.translate(0, 0, -length / 2);
    if (alongX) geometry.rotateY(Math.PI / 2);

    const mesh = new THREE.Mesh(geometry, material(COLORS.roof));
    mesh.position.set(x, y, z);
    mesh.castShadow = true;
    parent.add(mesh);
}

function windows(parent, width, depth, x, z, height) {
    const count = Math.floor(width / 3.2);
    for (let i = 0; i < count; i++) {
        const offset = (i - (count - 1) / 2) * 3.2;
        for (const side of [-1, 1]) {
            box(parent, [1.5, 1.3, 0.12], [x + offset, height * 0.58, z + side * (depth / 2 + 0.03)], COLORS.glass);
        }
    }
    const sideCount = Math.floor(depth / 3.2);
    for (let i = 0; i < sideCount; i++) {
        const offset = (i - (sideCount - 1) / 2) * 3.2;
        for (const side of [-1, 1]) {
            box(parent, [0.12, 1.3, 1.5], [x + side * (width / 2 + 0.03), height * 0.58, z + offset], COLORS.glass);
        }
    }
}

function building(parent, zone, { size: [width, depth], at: [x, z], height = 4 }) {
    const group = new THREE.Group();
    group.userData.zone = zone;
    box(group, [width, height, depth], [x, height / 2, z], COLORS.wall);
    box(group, [width + 0.1, 0.9, depth + 0.1], [x, 0.45, z], ZONES[zone].color);
    windows(group, width, depth, x, z, height);
    roof(group, width, depth, x, height, z, width >= depth);
    parent.add(group);
    return group;
}

function tree(parent, x, z, scale = 1) {
    cylinder(parent, 0.28 * scale, 0.42 * scale, 2.6 * scale, [x, 1.3 * scale, z], COLORS.wood, 8);
    const crown = new THREE.Mesh(new THREE.IcosahedronGeometry(1.9 * scale, 1), material(COLORS.tree));
    crown.position.set(x, 3.8 * scale, z);
    crown.castShadow = true;
    parent.add(crown);
}

// Galerie couverte autour du patio : l'ombre y sert de zone de transition.
function gallery(parent) {
    const shade = 0xece1cb;
    box(parent, [32, 0.25, 2.4], [0, 3.1, -7.8], shade);
    box(parent, [32, 0.25, 2.4], [0, 3.1, 7.8], shade);
    box(parent, [2.4, 0.25, 13.2], [-14.8, 3.1, 0], shade);
    box(parent, [2.4, 0.25, 13.2], [14.8, 3.1, 0], shade);

    for (let x = -15; x <= 15; x += 5) {
        for (const z of [-6.8, 6.8]) {
            if (Math.abs(x) < 3 && z > 0) continue; // passage de l'entrée
            cylinder(parent, 0.14, 0.14, 3, [x, 1.5, z], COLORS.wood, 8);
        }
    }
    for (let z = -4; z <= 4; z += 4) {
        for (const x of [-13.8, 13.8]) cylinder(parent, 0.14, 0.14, 3, [x, 1.5, z], COLORS.wood, 8);
    }
}

function garden(parent) {
    const group = new THREE.Group();
    group.userData.zone = 'jardin';

    box(group, [26, 0.1, 12.5], [0, 0.06, 0], COLORS.lawn);

    // Chemin en boucle : on y marche sur des surfaces différentes sans jamais se perdre.
    const path = new THREE.Mesh(new THREE.TorusGeometry(4, 0.42, 8, 48), material(COLORS.path));
    path.rotation.x = Math.PI / 2;
    path.scale.set(1.45, 1, 1);
    path.position.set(-4.5, 0.12, 0);
    path.receiveShadow = true;
    group.add(path);

    const basin = cylinder(group, 1.6, 1.6, 0.12, [-4.5, 0.16, 0], COLORS.water, 32);
    basin.castShadow = false;
    box(group, [0.9, 0.1, 6], [0, 0.13, 8], COLORS.path);

    for (const [x, z] of [[-11, -4], [-11, 3], [1, -4.5], [-1, 4.5]]) tree(group, x, z);

    // Potager en bacs surélevés, à hauteur d'enfant.
    for (const x of [2.5, 4.4]) {
        box(group, [1.5, 0.45, 3], [x, 0.3, -4], COLORS.wood);
        box(group, [1.3, 0.2, 2.8], [x, 0.56, -4], 0x5f8f4a);
    }

    parent.add(group);
}

function familyHouse(parent) {
    const group = new THREE.Group();
    group.userData.zone = 'familles';
    const { color } = ZONES.familles;

    cylinder(group, 4, 4, 0.3, [8, 0.15, 0], color, 32);
    for (let i = 0; i < 8; i++) {
        const angle = (i / 8) * Math.PI * 2;
        cylinder(group, 0.16, 0.2, 3, [8 + Math.cos(angle) * 3.3, 1.65, Math.sin(angle) * 3.3], COLORS.wood, 8);
    }
    const thatch = new THREE.Mesh(new THREE.ConeGeometry(5, 2.8, 24), material(COLORS.thatch));
    thatch.position.set(8, 4.5, 0);
    thatch.castShadow = true;
    group.add(thatch);
    parent.add(group);
}

function housing(parent) {
    const group = new THREE.Group();
    group.userData.zone = 'logement';

    for (const x of [-13, 0, 13]) {
        box(group, [10, 3.4, 6.5], [x, 1.7, -30], COLORS.wall);
        box(group, [10.1, 0.8, 6.6], [x, 0.4, -30], ZONES.logement.color);
        windows(group, 10, 6.5, x, -30, 3.4);
        roof(group, 10, 6.5, x, 3.4, -30, true);
        box(group, [8, 0.03, 3.4], [x, 5.1, -31.3], COLORS.solar).rotation.x = -0.38;
    }
    parent.add(group);
}

// Enceinte fermée, indispensable car certains enfants ne perçoivent pas le danger.
function enclosure(parent) {
    const [west, east, north, south] = [-32, 32, -39, 28];
    box(parent, [east - west, 1.7, 0.3], [0, 0.85, north], COLORS.wall);
    box(parent, [0.3, 1.7, south - north], [west, 0.85, (north + south) / 2], COLORS.wall);
    box(parent, [0.3, 1.7, south - north], [east, 0.85, (north + south) / 2], COLORS.wall);
    box(parent, [28, 1.7, 0.3], [-18, 0.85, south], COLORS.wall);
    box(parent, [28, 1.7, 0.3], [18, 0.85, south], COLORS.wall);
    for (const x of [-4.2, 4.2]) box(parent, [0.6, 4.4, 0.6], [x, 2.2, south], COLORS.wood);
    gateName(parent, south);
}

// Le nom du centre, en haut du portail.
function gateName(parent, z) {
    const texture = document.createElement('canvas');
    texture.width = 1024;
    texture.height = 170;
    const context = texture.getContext('2d');
    context.fillStyle = '#0055a5';
    context.fillRect(0, 0, 1024, 170);
    context.fillStyle = '#fff';
    context.font = '800 92px Inter, sans-serif';
    context.textAlign = 'center';
    context.textBaseline = 'middle';
    context.fillText('LE CENTRE NESA', 512, 90);

    const map = new THREE.CanvasTexture(texture);
    map.colorSpace = THREE.SRGBColorSpace;
    map.anisotropy = 8;

    const edge = material(0x0055a5);
    const name = new THREE.Mesh(new THREE.BoxGeometry(9.6, 1.6, 0.4), [
        edge, edge, edge, edge, new THREE.MeshStandardMaterial({ map, roughness: 0.7 }), edge,
    ]);
    name.position.set(0, 4, z + 0.4);
    name.castShadow = true;
    parent.add(name);
}

// Grande pancarte sur le mur d'enceinte, à côté du portail, avec le logo de l'ONG.
function sign(parent, onReady) {
    const texture = document.createElement('canvas');
    texture.width = 1024;
    texture.height = 440;
    const context = texture.getContext('2d');
    context.fillStyle = '#fff';
    context.fillRect(0, 0, 1024, 440);

    const map = new THREE.CanvasTexture(texture);
    map.colorSpace = THREE.SRGBColorSpace;
    map.anisotropy = 8;

    const logo = new Image();
    logo.onload = () => {
        const height = 400;
        const width = height * logo.naturalWidth / logo.naturalHeight;
        context.drawImage(logo, (1024 - width) / 2, 20, width, height);
        map.needsUpdate = true;
        onReady();
    };
    logo.src = new URL('../images/logo-eva.png', import.meta.url).href;

    const edge = material(0x0055a5);
    const panel = new THREE.Mesh(new THREE.BoxGeometry(16, 6.9, 0.3), [
        edge, edge, edge, edge, new THREE.MeshStandardMaterial({ map, roughness: 0.7 }), edge,
    ]);
    panel.position.set(-16, 3.6, 28.3);
    panel.castShadow = true;
    parent.add(panel);
}

function buildScene(scene, onReady) {
    const ground = new THREE.Mesh(new THREE.PlaneGeometry(240, 240), material(COLORS.ground));
    ground.rotation.x = -Math.PI / 2;
    ground.receiveShadow = true;
    scene.add(ground);

    box(scene, [62, 0.04, 65], [0, 0.02, -5.5], 0xa9c27f);
    box(scene, [6, 0.06, 19], [0, 0.05, 19.5], COLORS.path);

    building(scene, 'accueil', { size: [14, 8], at: [-12, 13] });
    building(scene, 'formation', { size: [17, 8], at: [12, 13] });
    building(scene, 'classes', { size: [19, 8], at: [-11, -13] });
    building(scene, 'therapies', { size: [16, 8], at: [10, -13] });
    building(scene, 'sensoriel', { size: [8, 15], at: [-22, 0], height: 3.6 });
    building(scene, 'ateliers', { size: [8, 22], at: [22, 0] });

    gallery(scene);
    garden(scene);
    familyHouse(scene);
    housing(scene);
    enclosure(scene);
    sign(scene, onReady);

    for (const [x, z] of [[-28, 22], [-16, 24], [18, 24], [28, 20], [-28, -22], [28, -22], [-26, -36], [26, -36], [-28, 10], [28, 12]]) {
        tree(scene, x, z, 1.25);
    }
}

function addLights(scene) {
    scene.add(new THREE.HemisphereLight(0xffffff, 0xcdbb99, 1.7));

    const sun = new THREE.DirectionalLight(0xfff4e0, 2.2);
    sun.position.set(30, 50, 25);
    sun.castShadow = true;
    sun.shadow.mapSize.set(2048, 2048);
    Object.assign(sun.shadow.camera, { left: -50, right: 50, top: 50, bottom: -50, far: 130 });
    sun.shadow.bias = -0.0004;
    scene.add(sun);
}

function start(renderer) {
    const scene = new THREE.Scene();
    scene.background = new THREE.Color(0xdcecf7);
    const camera = new THREE.PerspectiveCamera(38, 1, 1, 400);
    camera.position.copy(OVERVIEW.position);

    renderer.setPixelRatio(Math.min(devicePixelRatio, 2));
    renderer.shadowMap.enabled = true;
    renderer.shadowMap.type = THREE.PCFSoftShadowMap;

    addLights(scene);
    buildScene(scene, () => requestDraw());

    const controls = new OrbitControls(camera, canvas);
    controls.target.copy(OVERVIEW.target);
    controls.enableDamping = false;
    controls.enablePan = false;
    controls.enableZoom = false; // la molette et le pincement restent à la page ; zoom par les boutons
    controls.maxPolarAngle = Math.PI * 0.46;
    controls.minDistance = 22;
    controls.maxDistance = 120;
    canvas.style.touchAction = 'pan-y'; // glisser verticalement fait toujours défiler la page

    const pins = Object.keys(ZONES).map((id, index) => {
        const pin = document.createElement('button');
        pin.type = 'button';
        pin.className = 'c3d-pin';
        pin.textContent = index + 1;
        pin.setAttribute('aria-label', root.querySelector(`[data-c3d-zone="${id}"] .c3d-zone-title`).textContent);
        pin.addEventListener('click', () => select(id));
        pinsLayer.append(pin);
        return { id, pin, point: new THREE.Vector3(...ZONES[id].pin) };
    });

    let frame = 0;
    let flight = null;

    function draw() {
        frame = 0;
        if (flight) stepFlight();
        controls.update();
        renderer.render(scene, camera);

        const { clientWidth: width, clientHeight: height } = canvas;
        const projected = new THREE.Vector3();
        for (const { pin, point } of pins) {
            projected.copy(point).project(camera);
            pin.style.transform = `translate(${(projected.x + 1) / 2 * width}px, ${(1 - projected.y) / 2 * height}px) translate(-50%, -50%)`;
        }
    }

    const requestDraw = () => { frame ||= requestAnimationFrame(draw); };

    function stepFlight() {
        const progress = Math.min((performance.now() - flight.startedAt) / flight.duration, 1);
        const eased = 1 - (1 - progress) ** 3;
        camera.position.lerpVectors(flight.fromPosition, flight.position, eased);
        controls.target.lerpVectors(flight.fromTarget, flight.target, eased);
        if (progress < 1) requestDraw();
        else flight = null;
    }

    function flyTo(position, target) {
        flight = {
            fromPosition: camera.position.clone(), fromTarget: controls.target.clone(),
            position, target, startedAt: performance.now(), duration: reducedMotion ? 1 : 750,
        };
        requestDraw();
    }

    function select(id) {
        root.querySelectorAll('[data-c3d-zone]').forEach(button => {
            button.setAttribute('aria-expanded', String(button.dataset.c3dZone === id));
        });
        pins.forEach(({ id: pinId, pin }) => pin.classList.toggle('is-active', pinId === id));

        if (!id) return flyTo(OVERVIEW.position.clone(), OVERVIEW.target.clone());

        const target = new THREE.Vector3(...ZONES[id].view);
        flyTo(target.clone().add(new THREE.Vector3(14, 30, 34)), target);
    }

    function resize() {
        const { clientWidth: width, clientHeight: height } = canvas;
        renderer.setSize(width, height, false);
        camera.aspect = width / height;
        camera.fov = camera.aspect < 1 ? 52 : 38; // sur téléphone, le site entier reste visible
        camera.updateProjectionMatrix();
        requestDraw();
    }

    function zoom(factor) {
        const offset = camera.position.clone().sub(controls.target).multiplyScalar(factor);
        const distance = THREE.MathUtils.clamp(offset.length(), controls.minDistance, controls.maxDistance);
        camera.position.copy(controls.target).add(offset.setLength(distance));
        requestDraw();
    }

    // Un clic sur un bâtiment le sélectionne ; un glisser ne fait que tourner la vue.
    const raycaster = new THREE.Raycaster();
    let pressedAt = null;
    canvas.addEventListener('pointerdown', event => { pressedAt = [event.clientX, event.clientY]; });
    canvas.addEventListener('pointerup', event => {
        if (!pressedAt || Math.hypot(event.clientX - pressedAt[0], event.clientY - pressedAt[1]) > 6) return;
        const rect = canvas.getBoundingClientRect();
        raycaster.setFromCamera(new THREE.Vector2(
            (event.clientX - rect.left) / rect.width * 2 - 1,
            -((event.clientY - rect.top) / rect.height) * 2 + 1,
        ), camera);

        for (const { object } of raycaster.intersectObjects(scene.children, true)) {
            let node = object;
            while (node && !node.userData.zone) node = node.parent;
            if (node) return select(node.userData.zone);
            if (object.geometry.type !== 'PlaneGeometry') return;
        }
    });

    controls.addEventListener('change', requestDraw);
    root.querySelectorAll('[data-c3d-zone]').forEach(button => {
        button.addEventListener('click', () => {
            select(button.getAttribute('aria-expanded') === 'true' ? null : button.dataset.c3dZone);
        });
    });
    root.querySelector('[data-c3d-reset]').addEventListener('click', () => select(null));
    root.querySelectorAll('[data-c3d-zoom]').forEach(button => {
        button.addEventListener('click', () => zoom(button.dataset.c3dZoom === 'in' ? 0.8 : 1.25));
    });

    new ResizeObserver(resize).observe(canvas);
    resize();
}

const renderer = makeRenderer();

if (renderer) {
    root.classList.add('is-ready');
    start(renderer);
} else {
    root.querySelector('[data-c3d-fallback]').hidden = false;
}
