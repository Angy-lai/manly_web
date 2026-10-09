<?php
/**
 * Helper Functions for Apex Sports Club Website
 * ISE 2102: Web Technologies
 */

/**
 * Safely escape string for HTML output
 */
function sanitize(string $data): string {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

/**
 * Determine if current page matches given filename to set active nav link class
 */
function is_active(string $page): string {
    $currentPage = basename($_SERVER['PHP_SELF']);
    return ($currentPage === $page) ? 'active' : '';
}

/**
 * Return club sample core activities
 */
function get_activities_list(): array {
    return [
        [
            'id' => 'football',
            'name' => 'Football',
            'tagline' => 'Play together. Compete together.',
            'description' => 'Weekly training matches, tactical drills, and interfaculty league games for all skill levels.',
            'icon' => '⚽',
            'image' => 'assets/pic_of_balls.jpeg',
            'badge' => 'Outdoor & Turf'
        ],
        [
            'id' => 'basketball',
            'name' => 'Basketball',
            'tagline' => 'Find your rhythm on the court.',
            'description' => 'Half-court pickups, 3v3 mini-tournaments, shooting clinics, and fast-paced 5v5 scrimmages.',
            'icon' => '🏀',
            'image' => 'assets/sports.jpeg',
            'badge' => 'Indoor Sports Hall'
        ],
        [
            'id' => 'fitness',
            'name' => 'Gym & Fitness',
            'tagline' => 'Build strength one session at a time.',
            'description' => 'High-intensity interval training, calisthenics, functional strength circuits, and mobility coaching.',
            'icon' => '💪',
            'image' => 'assets/girl_holding_ropes.jpeg',
            'badge' => 'Campus Gym & Studio'
        ],
        [
            'id' => 'volleyball',
            'name' => 'Volleyball',
            'tagline' => 'Teamwork above the net.',
            'description' => 'Spiking and setting workshops, sand volleyball socials, and mixed indoor team challenges.',
            'icon' => '🏐',
            'image' => 'assets/volley.jpeg',
            'badge' => 'Multi-Sport Court'
        ],
        [
            'id' => 'running',
            'name' => 'Running & Athletics',
            'tagline' => 'Set a goal. Find your pace.',
            'description' => 'Campus 5K group jogs, sprint mechanics sessions, track intervals, and seasonal fun runs.',
            'icon' => '🏃',
            'image' => 'assets/sports.jpeg',
            'badge' => 'Athletics Track'
        ],
        [
            'id' => 'social',
            'name' => 'Social Sports & Recreation',
            'tagline' => 'Movement, laughter, and community.',
            'description' => 'Casual weekend tournaments, badminton mixups, dodgeball fun days, and sports meetups.',
            'icon' => '🏆',
            'image' => 'assets/pic_of_balls.jpeg',
            'badge' => 'Open Campus Green'
        ]
    ];
}

/**
 * Return sample upcoming events
 * Labelled explicitly as academic demonstration sample events
 */
function get_sample_events(): array {
    return [
        [
            'id' => 1,
            'title' => 'Community Football Match',
            'category' => 'Football',
            'date' => '2026-11-07',
            'time' => '14:00 - 16:30',
            'venue' => 'Sample Sports Field (Turf Pitch 1)',
            'description' => 'A friendly open-pitch match for university students to play, build team chemistry, and connect.',
            'spots' => 'Open to all students'
        ],
        [
            'id' => 2,
            'title' => 'Campus Fitness Challenge',
            'category' => 'Fitness',
            'date' => '2026-11-14',
            'time' => '09:00 - 11:30',
            'venue' => 'Sample Fitness Area (Studio A)',
            'description' => 'Take on a fun sequence of functional fitness stations and bodyweight exercises at your own pace.',
            'spots' => 'Beginner friendly'
        ],
        [
            'id' => 3,
            'title' => 'Basketball Open Session',
            'category' => 'Basketball',
            'date' => '2026-11-21',
            'time' => '15:00 - 17:00',
            'venue' => 'Sample Basketball Court (Court B)',
            'description' => 'Open run scrimmages and shooting drills designed for casual players and seasoned hoopers alike.',
            'spots' => 'Drop-in welcome'
        ],
        [
            'id' => 4,
            'title' => 'Volleyball Sunset Scrimmage',
            'category' => 'Volleyball',
            'date' => '2026-11-28',
            'time' => '16:30 - 18:30',
            'venue' => 'Sample Multi-Sport Court',
            'description' => 'Friendly mixed-gender volleyball matches focused on communication, rallies, and great energy.',
            'spots' => 'Co-ed teams'
        ],
        [
            'id' => 5,
            'title' => 'Track & 5K Campus Run',
            'category' => 'Running',
            'date' => '2026-12-05',
            'time' => '07:30 - 09:00',
            'venue' => 'Sample Athletics Track & Campus Loop',
            'description' => 'A guided morning run across campus grounds with dedicated pace groups for all stamina levels.',
            'spots' => 'All pace groups'
        ]
    ];
}
