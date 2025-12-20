<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Migrate profile data from users table to profiles table
        $users = DB::table('users')->whereNotNull('bio')
            ->orWhereNotNull('phone')
            ->orWhereNotNull('address')
            ->orWhereNotNull('avatar')
            ->orWhereNotNull('date_of_birth')
            ->orWhereNotNull('location')
            ->orWhereNotNull('website')
            ->get();

        foreach ($users as $user) {
            // Check if profile already exists
            $profileExists = DB::table('profiles')->where('user_id', $user->id)->exists();
            
            if (!$profileExists) {
                DB::table('profiles')->insert([
                    'user_id' => $user->id,
                    'bio' => $user->bio,
                    'phone' => $user->phone,
                    'address' => $user->address,
                    'avatar' => $user->avatar,
                    'date_of_birth' => $user->date_of_birth,
                    'location' => $user->location,
                    'website' => $user->website,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Create profiles for users that don't have profile data yet
        $usersWithoutProfiles = DB::table('users')
            ->leftJoin('profiles', 'users.id', '=', 'profiles.user_id')
            ->whereNull('profiles.user_id')
            ->select('users.id')
            ->get();

        foreach ($usersWithoutProfiles as $user) {
            DB::table('profiles')->insert([
                'user_id' => $user->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Copy data back from profiles to users
        $profiles = DB::table('profiles')->get();

        foreach ($profiles as $profile) {
            DB::table('users')
                ->where('id', $profile->user_id)
                ->update([
                    'bio' => $profile->bio,
                    'phone' => $profile->phone,
                    'address' => $profile->address,
                    'avatar' => $profile->avatar,
                    'date_of_birth' => $profile->date_of_birth,
                    'location' => $profile->location,
                    'website' => $profile->website,
                ]);
        }
    }
};
