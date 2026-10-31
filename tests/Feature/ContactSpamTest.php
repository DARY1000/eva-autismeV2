<?php

namespace Tests\Feature;

use App\Models\Contact;
use App\Support\SpamGuard;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Crypt;
use Tests\TestCase;

class ContactSpamTest extends TestCase
{
    use RefreshDatabase;

    private function payload(array $overrides = []): array
    {
        return array_merge([
            'subject'      => 'Devenir partenaire',
            'prenom'       => 'Amina',
            'nom'          => 'Dossou',
            'email'        => 'amina@example.org',
            'organization' => 'Association Espoir',
            'message'      => 'Bonjour, notre association souhaite collaborer avec vous sur la sensibilisation à Parakou.',
            '_form_ts'     => Crypt::encryptString((string) (time() - 30)),
        ], $overrides);
    }

    public function test_a_genuine_message_reaches_the_inbox(): void
    {
        $this->post(route('contact.send'), $this->payload())->assertSessionHas('success');

        $this->assertSame('new', Contact::sole()->status);
    }

    public function test_the_spam_received_by_the_ngo_is_classified_as_spam(): void
    {
        $this->post(route('contact.send'), $this->payload([
            'prenom'       => 'EdwardlapAT',
            'nom'          => 'Edwardlap',
            'organization' => 'Edwardlap',
            'message'      => 'Read the news and contextualize data for $50,000,000 per month https://telegra.ph/Read-the-latest-news-and-earn-50000000-in-a-month-Message-ID-118398-10-05',
        ]))->assertSessionHas('success');

        $this->assertSame('spam', Contact::sole()->status);
    }

    public function test_the_honeypot_blocks_robots_without_storing_anything(): void
    {
        $this->post(route('contact.send'), $this->payload(['website' => 'http://spam.test']))->assertRedirect();

        $this->assertSame(0, Contact::count());
    }

    public function test_a_form_sent_instantly_or_without_token_is_ignored(): void
    {
        $this->post(route('contact.send'), $this->payload(['_form_ts' => Crypt::encryptString((string) time())]));
        $this->post(route('contact.send'), $this->payload(['_form_ts' => 'faux']));

        $this->assertSame(0, Contact::count());
    }

    public function test_a_link_alone_does_not_reject_a_real_partner(): void
    {
        $this->assertFalse(SpamGuard::isSpam('Amina Dossou', 'Association Espoir', 'Bonjour, voici notre site https://espoir.bj pour découvrir nos actions à Parakou.'));
    }

    public function test_repeated_posts_are_rate_limited(): void
    {
        foreach (range(1, 3) as $i) {
            $this->post(route('contact.send'), $this->payload());
        }

        $this->post(route('contact.send'), $this->payload())->assertStatus(429);
    }
}
