<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Story;
use App\Models\User;
use Carbon\Carbon;
use Database\Seeders\Concerns\SeedsRemoteMedia;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

class DemoSeeder extends Seeder
{
    use SeedsRemoteMedia;

    private const PASSWORD = '@user123';

  /**
     * Curated Unsplash URLs (stable hotlink-friendly links).
     *
     * @return array<int, array<string, mixed>>
     */
    private function demoUsers(): array
    {
        return [
            [
                'name' => 'Emma Wilson',
                'username' => 'emma',
                'email' => 'emma@gmail.com',
                'bio' => 'Travel & lifestyle photographer. Chasing golden hour.',
                'gender' => 'female',
                'is_verified' => true,
                'avatar' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=400&h=400&fit=crop&crop=face',
                'stories' => [
                    'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=1080&h=1920&fit=crop',
                    'https://images.unsplash.com/photo-1469474968028-56623f02e42e?w=1080&h=1920&fit=crop',
                ],
            ],
            [
                'name' => 'James Chen',
                'username' => 'james',
                'email' => 'james@demo.com',
                'bio' => 'Street food explorer. Coffee first, questions later.',
                'gender' => 'male',
                'is_verified' => false,
                'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=400&fit=crop&crop=face',
                'stories' => [
                    'https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=1080&h=1920&fit=crop',
                    'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?w=1080&h=1920&fit=crop',
                ],
            ],
            [
                'name' => 'Sofia Martinez',
                'username' => 'sofia',
                'email' => 'sofia@demo.com',
                'bio' => 'Interior design & slow living.',
                'gender' => 'female',
                'is_verified' => true,
                'avatar' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=400&h=400&fit=crop&crop=face',
                'stories' => [
                    'https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?w=1080&h=1920&fit=crop',
                ],
            ],
            [
                'name' => 'Noah Taylor',
                'username' => 'noah',
                'email' => 'noah@demo.com',
                'bio' => 'Weekend hikes and film photography.',
                'gender' => 'male',
                'is_verified' => false,
                'avatar' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=400&h=400&fit=crop&crop=face',
                'stories' => [
                    'https://images.unsplash.com/photo-1682687220742-aba13b6e50ba?w=1080&h=1920&fit=crop',
                    'https://images.unsplash.com/photo-1470071459604-3b5ec3a7fe05?w=1080&h=1920&fit=crop',
                ],
            ],
            [
                'name' => 'Mia Anderson',
                'username' => 'mia',
                'email' => 'mia@demo.com',
                'bio' => 'Fitness coach. Stronger every day.',
                'gender' => 'female',
                'is_verified' => false,
                'avatar' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=400&h=400&fit=crop&crop=face',
                'stories' => [
                    'https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b?w=1080&h=1920&fit=crop',
                ],
            ],
            [
                'name' => 'Lucas Brown',
                'username' => 'lucas',
                'email' => 'lucas@demo.com',
                'bio' => 'Music producer & vinyl collector.',
                'gender' => 'male',
                'is_verified' => false,
                'avatar' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=400&h=400&fit=crop&crop=face',
                'stories' => [
                    'https://images.unsplash.com/photo-1511379938547-c1f69419868d?w=1080&h=1920&fit=crop',
                    'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=1080&h=1920&fit=crop',
                ],
            ],
            [
                'name' => 'User 1',
                'username' => 'user_1',
                'email' => 'user1@gmail.com',
                'bio' => 'Demo account for client walkthrough.',
                'gender' => 'other',
                'is_verified' => false,
                'avatar' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=400&h=400&fit=crop&crop=face',
                'stories' => [
                    'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?w=1080&h=1920&fit=crop',
                    'https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=1080&h=1920&fit=crop',
                ],
            ],
            [
                'name' => 'User 2',
                'username' => 'user_2',
                'email' => 'user2@gmail.com',
                'bio' => 'Second demo account — follow user_1 to see their story.',
                'gender' => 'other',
                'is_verified' => false,
                'avatar' => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=400&h=400&fit=crop&crop=face',
                'stories' => [
                    'https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=1080&h=1920&fit=crop',
                    'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?w=1080&h=1920&fit=crop',
                ],
            ],
        ];
    }

    /**
     * @return array<string, list<string>>
     */
    private function followMap(): array
    {
        return [
            'emma' => ['james', 'sofia', 'noah', 'user_1'],
            'james' => ['emma', 'mia', 'lucas', 'user_2'],
            'sofia' => ['emma', 'james', 'mia', 'user_1'],
            'noah' => ['emma', 'lucas', 'user_2'],
            'mia' => ['james', 'sofia', 'lucas', 'user_1', 'user_2'],
            'lucas' => ['noah', 'mia', 'emma'],
            'user_1' => ['user_2', 'emma', 'james', 'sofia'],
            'user_2' => ['user_1', 'emma', 'mia', 'noah'],
        ];
    }

    public function run(): void
    {
        $this->command?->info('Seeding demo data (users, follows, posts, stories, engagement)...');

        $users = $this->createUsers();
        $this->seedFollows($users);
        $posts = $this->seedPosts($users);
        $this->seedStories($users);
        $this->seedEngagement($users, $posts);

        $this->printCredentials($users);
    }

    /**
     * @return Collection<string, User>
     */
    private function createUsers(): Collection
    {
        $users = collect();

        foreach ($this->demoUsers() as $data) {
            $photoPath = "images/seed/{$data['username']}.jpg";
            $downloaded = $this->downloadToPublic($data['avatar'], $photoPath);

            $user = User::create([
                'name' => $data['name'],
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => Hash::make(self::PASSWORD),
                'photo' => $downloaded ?? 'images/user.jpg',
                'bio' => $data['bio'],
                'gender' => $data['gender'],
                'is_verified' => $data['is_verified'],
                'email_verified_at' => now(),
            ]);

            $users->put($data['username'], $user);
        }

        return $users;
    }

    /**
     * @param  Collection<string, User>  $users
     */
    private function seedFollows(Collection $users): void
    {
        foreach ($this->followMap() as $followerUsername => $followingUsernames) {
            $follower = $users->get($followerUsername);

            foreach ($followingUsernames as $followingUsername) {
                $follower->follow($users->get($followingUsername));
            }
        }
    }

    /**
     * @param  Collection<string, User>  $users
     * @return Collection<int, Post>
     */
    private function seedPosts(Collection $users): Collection
    {
        $captions = [
            'Moments like this are worth remembering.',
            'Grateful for today.',
            'New week, new energy.',
            'Still thinking about this view.',
            'Good vibes only.',
            'Weekend mode activated.',
            'Little things, big joy.',
            'Out here making memories.',
        ];

        $locations = ['Paris', 'Tokyo', 'New York', 'Bali', 'London', 'Barcelona', 'Sydney', 'Dubai'];

        $posts = collect();

        foreach ($users as $user) {
            foreach (range(1, 4) as $index) {
                $post = Post::factory()
                    ->for($user)
                    ->create([
                        'type' => 'post',
                        'description' => $captions[array_rand($captions)],
                        'location' => $locations[array_rand($locations)],
                        'allow_commenting' => true,
                        'hide_like_view' => false,
                        'created_at' => now()->subDays(rand(1, 14))->subHours(rand(1, 12)),
                    ]);

                $posts->push($post);
            }

            $reel = Post::factory()
                ->for($user)
                ->create([
                    'type' => 'reel',
                    'description' => 'Quick reel from the week.',
                    'location' => $locations[array_rand($locations)],
                    'allow_commenting' => true,
                    'created_at' => now()->subDays(rand(1, 7)),
                ]);

            $posts->push($reel);
        }

        return $posts;
    }

    /**
     * @param  Collection<string, User>  $users
     */
    private function seedStories(Collection $users): void
    {
        $storyTexts = [
            'Behind the scenes',
            'Today was a good day',
            'Swipe up for more',
            null,
        ];

        foreach ($this->demoUsers() as $data) {
            $user = $users->get($data['username']);

            foreach ($data['stories'] as $index => $url) {
                $storagePath = "stories/{$data['username']}_{$index}.jpg";
                $mediaPath = $this->downloadToStorage($url, $storagePath);

                if (! $mediaPath) {
                    continue;
                }

                Story::create([
                    'user_id' => $user->id,
                    'media_type' => 'image',
                    'media_url' => $mediaPath,
                    'text' => $storyTexts[array_rand($storyTexts)],
                    'expires_at' => Carbon::now()->addHours(24),
                    'created_at' => now()->subHours(rand(1, 8)),
                ]);
            }
        }
    }

    /**
     * @param  Collection<string, User>  $users
     * @param  Collection<int, Post>  $posts
     */
    private function seedEngagement(Collection $users, Collection $posts): void
    {
        $userList = $users->values();

        foreach ($posts as $post) {
            $commenters = $userList
                ->where('id', '!=', $post->user_id)
                ->shuffle()
                ->take(rand(2, 4));

            foreach ($commenters as $commenter) {
                $parent = Comment::factory()->create([
                    'user_id' => $commenter->id,
                    'commentable_id' => $post->id,
                    'commentable_type' => Post::class,
                    'body' => fake()->sentence(rand(4, 10)),
                ]);

                if (rand(0, 1)) {
                    $replier = $userList
                        ->where('id', '!=', $commenter->id)
                        ->random();

                    Comment::factory()
                        ->isReply($post)
                        ->create([
                            'parent_id' => $parent->id,
                            'user_id' => $replier->id,
                            'body' => fake()->sentence(rand(3, 8)),
                        ]);
                }
            }

            $likers = $userList
                ->where('id', '!=', $post->user_id)
                ->shuffle()
                ->take(rand(3, min(6, $userList->count() - 1)));

            foreach ($likers as $liker) {
                $liker->like($post);
            }

            if (rand(0, 2) === 0) {
                $userList
                    ->where('id', '!=', $post->user_id)
                    ->random()
                    ->favorite($post);
            }
        }
    }

    /**
     * @param  Collection<string, User>  $users
     */
    private function printCredentials(Collection $users): void
    {
        $rows = $users
            ->map(fn (User $user) => [$user->name, $user->username, $user->email, self::PASSWORD])
            ->values()
            ->all();

        $this->command?->newLine();
        $this->command?->info('Demo accounts ready — all use password: '.self::PASSWORD);
        $this->command?->table(['Name', 'Username', 'Email', 'Password'], $rows);
        $this->command?->info('Tip: log in as user1@gmail.com and user2@gmail.com — they follow each other and have active stories.');
    }
}
