<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\ShortUrl;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShortUrlTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_and_member_can_create_short_urls()
    {
        $company = Company::create(['name' => 'Test Company']);
        $admin = User::factory()->create(['role' => 'admin', 'company_id' => $company->id]);
        $member = User::factory()->create(['role' => 'member', 'company_id' => $company->id]);

        $this->actingAs($admin)
            ->post('/short_urls', ['original_url' => 'http://example.com'])
            ->assertRedirect('/short_urls');

        $this->actingAs($member)
            ->post('/short_urls', ['original_url' => 'http://example.com'])
            ->assertRedirect('/short_urls');
    }

    public function test_superadmin_cannot_create_short_urls()
    {
        $superadmin = User::factory()->create(['role' => 'superadmin']);

        $this->actingAs($superadmin)
            ->post('/short_urls', ['original_url' => 'http://example.com'])
            ->assertForbidden();
    }

    public function test_superadmin_can_see_all_short_urls()
    {
        $superadmin = User::factory()->create(['role' => 'superadmin']);
        $company = Company::create(['name' => 'Test Company']);
        
        ShortUrl::create([
            'original_url' => 'http://own.com',
            'short_code' => 'abc1',
            'user_id' => 1,
            'company_id' => $company->id,
        ]);

        $response = $this->actingAs($superadmin)->get('/short_urls');
        $response->assertSee('http://own.com');
    }

    public function test_admin_can_only_see_short_urls_created_in_their_own_company()
    {
        $company1 = Company::create(['name' => 'Company 1']);
        $company2 = Company::create(['name' => 'Company 2']);

        $admin = User::factory()->create(['role' => 'admin', 'company_id' => $company1->id]);
        
        $urlOwnCompany = ShortUrl::create([
            'original_url' => 'http://own.com',
            'short_code' => 'abc1',
            'user_id' => $admin->id,
            'company_id' => $company1->id,
        ]);

        $urlOtherCompany = ShortUrl::create([
            'original_url' => 'http://other.com',
            'short_code' => 'abc2',
            'user_id' => User::factory()->create(['company_id' => $company2->id])->id,
            'company_id' => $company2->id,
        ]);

        $response = $this->actingAs($admin)->get('/short_urls');

        $response->assertSee('http://own.com');
        $response->assertDontSee('http://other.com');
    }

    public function test_member_can_only_see_short_urls_created_by_themselves()
    {
        $company = Company::create(['name' => 'Test Company']);
        
        $member = User::factory()->create(['role' => 'member', 'company_id' => $company->id]);
        $otherUser = User::factory()->create(['role' => 'member', 'company_id' => $company->id]);

        $urlOwn = ShortUrl::create([
            'original_url' => 'http://own-member.com',
            'short_code' => 'mem1',
            'user_id' => $member->id,
            'company_id' => $company->id,
        ]);

        $urlOther = ShortUrl::create([
            'original_url' => 'http://other-member.com',
            'short_code' => 'mem2',
            'user_id' => $otherUser->id,
            'company_id' => $company->id,
        ]);

        $response = $this->actingAs($member)->get('/short_urls');

        $response->assertSee('http://own-member.com');
        $response->assertDontSee('http://other-member.com');
    }

    public function test_short_urls_are_publicly_resolvable_and_redirect_to_original()
    {
        $company = Company::create(['name' => 'Test Company']);
        $user = User::factory()->create(['company_id' => $company->id]);
        
        $url = ShortUrl::create([
            'original_url' => 'https://google.com',
            'short_code' => 'googl1',
            'user_id' => $user->id,
            'company_id' => $company->id,
        ]);

        // Should NOT redirect to login when accessed publicly, should redirect to google.com
        $this->get('/googl1')->assertRedirect('https://google.com');
    }
}
