import os, re

base = r'C:\xampp\htdocs\eva-temp\app\Filament\Resources'
for root, dirs, files in os.walk(base):
    for fname in files:
        if not fname.endswith('.php'):
            continue
        fpath = os.path.join(root, fname)
        with open(fpath, 'r', encoding='utf-8') as f:
            content = f.read()
        placeholder = '${resource}Resource'
        if placeholder not in content:
            continue
        m = re.search(r'\$resource\s*=\s*(\w+Resource)::class', content)
        if m:
            resource_name = m.group(1)
            replacement = '\\' + resource_name
            fixed = content.replace(placeholder, replacement)
            with open(fpath, 'w', encoding='utf-8') as f:
                f.write(fixed)
            print(f'Fixed: {fname} -> {resource_name}')
