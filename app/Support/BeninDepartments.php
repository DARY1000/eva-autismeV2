<?php

namespace App\Support;

use App\Models\SiteSetting;

/**
 * Présence de l'ONG par département. Le statut et la description par défaut
 * peuvent être remplacés depuis Réglages du site.
 */
class BeninDepartments
{
    public const STATUSES = [
        'principal' => 'Présence principale',
        'regulier'  => 'Activités régulières',
        'expansion' => 'En expansion',
        'a_venir'   => 'Objectif à venir',
    ];

    private const DEFAULTS = [
        'atlantique' => ['principal', 'Siège à Abomey-Calavi, actions communautaires à Ouidah'],
        'littoral'   => ['regulier', 'Cotonou : événements et partenariats'],
        'oueme'      => ['regulier', 'Porto-Novo : sensibilisation institutionnelle'],
        'borgou'     => ['expansion', 'Parakou : expansion vers le nord du Bénin'],
    ];

    /** Tracés de la carte, sans les statuts. */
    public static function map(): array
    {
        return json_decode(file_get_contents(resource_path('data/benin-departments.json')), true);
    }

    public static function defaultStatus(string $key): string
    {
        return self::DEFAULTS[$key][0] ?? 'a_venir';
    }

    public static function defaultDescription(string $key): string
    {
        return self::DEFAULTS[$key][1] ?? '';
    }

    /** Départements de la carte, complétés par leur statut et leur description. */
    public static function all(): array
    {
        $map      = self::map();
        $settings = SiteSetting::where('key', 'like', 'dept_%')->pluck('value', 'key');

        foreach ($map['departments'] as $key => &$department) {
            $status = $settings["dept_status_{$key}"] ?? self::defaultStatus($key);

            $department['status']       = array_key_exists($status, self::STATUSES) ? $status : 'a_venir';
            $department['status_label'] = self::STATUSES[$department['status']];
            $department['description']  = $settings["dept_note_{$key}"] ?? self::defaultDescription($key);
        }

        return $map;
    }
}
