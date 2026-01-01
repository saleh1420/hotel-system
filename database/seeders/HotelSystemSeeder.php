<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\TourismPackage;

class HotelSystemSeeder extends Seeder
{
    public function run(): void
    {
        // Create test user
        $user = User::firstOrCreate(
            ['email' => 'testuser@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password123'),
            ]
        );

        // Create a hotel
        $hotel = Hotel::create([
            'hotel_name' => 'Blue Sea Hotel',
            'location' => 'Istanbul',
            'description' => 'A seaside hotel with great views.',
            'stars' => 4,
            'phone' => '+90 555 000 0000',
            'email' => 'info@bluesea.com',
        ]);

        // Create rooms
        $room1 = Room::create([
            'hotel_id' => $hotel->id,
            'room_number' => '101',
            'type' => 'Double',
            'capacity' => 2,
            'price_per_night' => 1200.00,
            'status' => 'available',
        ]);

        $room2 = Room::create([
            'hotel_id' => $hotel->id,
            'room_number' => '102',
            'type' => 'Suite',
            'capacity' => 4,
            'price_per_night' => 2500.00,
            'status' => 'available',
        ]);

        // Tourism package
        TourismPackage::create([
            'hotel_id' => $hotel->id,
            'title' => 'Bosphorus Cruise + City Tour',
            'description' => 'Includes hotel pickup, cruise, and guided tour.',
            'price' => 800.00,
            'duration_days' => 1,
        ]);

        // Booking
        $booking = Booking::create([
            'user_id' => $user->id,
            'room_id' => $room1->id,
            'check_in' => now()->addDays(3)->toDateString(),
            'check_out' => now()->addDays(6)->toDateString(),
            'guests_count' => 2,
            'total_price' => 1200.00 * 3,
            'status' => 'confirmed',
        ]);

        // Payment
        Payment::create([
            'booking_id' => $booking->id,
            'amount' => $booking->total_price,
            'method' => 'card',
            'status' => 'paid',
            'transaction_ref' => 'TXN-' . time(),
        ]);
    }
}
