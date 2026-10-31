<?php

namespace App\Support;

/**
 * Évalue un message de contact. Rien n'est supprimé : au-delà du seuil,
 * le message est classé « spam » et reste consultable dans l'admin.
 */
class SpamGuard
{
    public const THRESHOLD = 3;

    private const SUSPICIOUS_LINKS = '~telegra\.ph|t\.me/|bit\.ly|tinyurl|goo\.gl|cutt\.ly|rb\.gy|is\.gd|wa\.link~i';

    private const SUSPICIOUS_WORDS = '~\b(earn|make money|per month|per day|passive income|crypto|bitcoin|forex|binary options?|casino|betting|poker|loan|backlinks?|seo|rank(ing)? (on|in) google|web ?design services?|viagra|cialis|porn|sex dating|gagner de l.argent|revenus? passifs?|investissement garanti)\b~iu';

    /** @return array{score: int, reasons: array<int, string>} */
    public static function inspect(string $name, ?string $organization, string $message): array
    {
        $reasons = [];
        $score   = 0;

        $flag = function (int $points, string $reason) use (&$score, &$reasons) {
            $score    += $points;
            $reasons[] = $reason;
        };

        if (preg_match(self::SUSPICIOUS_LINKS, $message)) {
            $flag(3, 'Lien raccourci ou suspect');
        } elseif (preg_match('~https?://|www\.~i', $message)) {
            $flag(2, 'Contient un lien');
        }

        if (preg_match(self::SUSPICIOUS_WORDS, $message)) {
            $flag(3, 'Vocabulaire publicitaire');
        }

        if (preg_match('~[$€£]\s?\d{1,3}([,. ]\d{3})+|\d{1,3}([,. ]\d{3})+\s?[$€£]~u', $message)) {
            $flag(2, 'Promesse d\'argent');
        }

        if (preg_match('~[\p{Cyrillic}\p{Han}\p{Hangul}\p{Thai}]~u', $name.' '.$message)) {
            $flag(3, 'Alphabet inhabituel');
        }

        $parts = preg_split('/\s+/', trim($name));
        if (count($parts) === 2 && mb_strlen($parts[1]) >= 4
            && stripos($parts[0], $parts[1]) === 0 && mb_strlen($parts[0]) > mb_strlen($parts[1])) {
            $flag(2, 'Nom généré automatiquement');
        }

        if ($organization && in_array(mb_strtolower(trim($organization)), array_map('mb_strtolower', $parts), true)) {
            $flag(1, 'Organisation identique au nom');
        }

        return ['score' => $score, 'reasons' => $reasons];
    }

    public static function isSpam(string $name, ?string $organization, string $message): bool
    {
        return self::inspect($name, $organization, $message)['score'] >= self::THRESHOLD;
    }
}
