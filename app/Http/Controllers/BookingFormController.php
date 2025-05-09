<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingFormController extends Controller
{
    /**
     * Display the desert excursion booking form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showDesertExcursionForm()
    {
        return view('booking.desert-excursion');
    }

    /**
     * Process the submitted booking form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function submitDesertExcursionForm(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'date' => 'required|date',
            'time_slot' => 'required',
            // Add more validation rules as needed
        ]);

        // Store all form data
        $bookingData = $request->all();

        // Extract selected items and their prices
        $selectedItems = $this->extractSelectedItems($request);

        // Calculate total price
        $totalPrice = $this->calculateTotalPrice($selectedItems);

        // Redirect to checkout page with the data
        return view('booking.checkout', [
            'bookingData' => $bookingData,
            'selectedItems' => $selectedItems,
            'totalPrice' => $totalPrice
        ]);
    }

    /**
     * Complete the booking process.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function completeBooking(Request $request)
    {
        // Validate customer details
        $validatedData = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
        ]);

        // Here you would typically:
        // 1. Save the booking to the database
        // 2. Send confirmation email
        // 3. Process payment if needed

        // For now, just redirect with success
        return redirect()->route('desert-excursion.success')->with('success', 'Your booking has been completed!');
    }

    /**
     * Display booking success page.
     *
     * @return \Illuminate\Http\Response
     */
    public function showSuccessPage()
    {
        return view('booking.success');
    }

    /**
     * Extract selected items from the form data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    private function extractSelectedItems(Request $request)
    {
        $selectedItems = [];
        $packageTypes = [
            // KTM Dirt Bike
            'dirt_bike_duration' => [
                '1_hour' => ['name' => 'KTM Dirt Bike 450 CC (1 Hour)', 'price' => 850, 'image' => 'https://desertbuggyrental.com/wp-content/uploads/2024/04/motocross-hire-in-dubai.webp'],
                '2_hour' => ['name' => 'KTM Dirt Bike 450 CC (2 Hours)', 'price' => 1250, 'image' => 'https://desertbuggyrental.com/wp-content/uploads/2024/04/motocross-hire-in-dubai.webp'],
                '3_hour' => ['name' => 'KTM Dirt Bike 450 CC (3 Hours)', 'price' => 1450, 'image' => 'https://desertbuggyrental.com/wp-content/uploads/2024/04/motocross-hire-in-dubai.webp']
            ],
            // Buggy 2 Seater
            'buggy_2_seater_duration' => [
                '30_min' => ['name' => '2 Seater Polaris Dune Buggy (30 Min)', 'price' => 600, 'image' => 'https://desertbuggyrental.com/wp-content/uploads/2024/04/2seaterbuggy.webp'],
                '1_hour' => ['name' => '2 Seater Polaris Dune Buggy (1 Hour)', 'price' => 900, 'image' => 'https://desertbuggyrental.com/wp-content/uploads/2024/04/2seaterbuggy.webp'],
                '2_hour' => ['name' => '2 Seater Polaris Dune Buggy (2 Hours)', 'price' => 1750, 'image' => 'https://desertbuggyrental.com/wp-content/uploads/2024/04/2seaterbuggy.webp']
            ],
            // Buggy 2 Seater Turbo
            'buggy_2_seater_turbo_duration' => [
                '30_min' => ['name' => '2 Seater Polaris Dune Buggy Turbo (30 Min)', 'price' => 900, 'image' => 'https://desertbuggyrental.com/wp-content/uploads/2024/04/2seaterbuggyturbo-1.webp'],
                '1_hour' => ['name' => '2 Seater Polaris Dune Buggy Turbo (1 Hour)', 'price' => 1200, 'image' => 'https://desertbuggyrental.com/wp-content/uploads/2024/04/2seaterbuggyturbo-1.webp'],
                '2_hour' => ['name' => '2 Seater Polaris Dune Buggy Turbo (2 Hours)', 'price' => 2200, 'image' => 'https://desertbuggyrental.com/wp-content/uploads/2024/04/2seaterbuggyturbo-1.webp']
            ],
            // Buggy 4 Seater
            'buggy_4_seater_duration' => [
                '30_min' => ['name' => '4 Seater Polaris Dune Buggy (30 Min)', 'price' => 800, 'image' => 'https://desertbuggyrental.com/wp-content/uploads/2024/04/4seaterbuggy.webp'],
                '1_hour' => ['name' => '4 Seater Polaris Dune Buggy (1 Hour)', 'price' => 1200, 'image' => 'https://desertbuggyrental.com/wp-content/uploads/2024/04/4seaterbuggy.webp'],
                '2_hour' => ['name' => '4 Seater Polaris Dune Buggy (2 Hours)', 'price' => 2200, 'image' => 'https://desertbuggyrental.com/wp-content/uploads/2024/04/4seaterbuggy.webp']
            ],
            // Buggy 4 Seater Turbo
            'buggy_4_seater_turbo_duration' => [
                '30_min' => ['name' => '4 Seater Polaris Dune Buggy Turbo (30 Min)', 'price' => 1200, 'image' => 'https://desertbuggyrental.com/wp-content/uploads/2024/04/4seaterturbo.webp'],
                '1_hour' => ['name' => '4 Seater Polaris Dune Buggy Turbo (1 Hour)', 'price' => 2150, 'image' => 'https://desertbuggyrental.com/wp-content/uploads/2024/04/4seaterturbo.webp'],
                '2_hour' => ['name' => '4 Seater Polaris Dune Buggy Turbo (2 Hours)', 'price' => 3975, 'image' => 'https://desertbuggyrental.com/wp-content/uploads/2024/04/4seaterturbo.webp']
            ],
            // Can-Am 2 Seater
            'canam_2_seater_duration' => [
                '30_min' => ['name' => '2 Seater Can-Am Maverick X3 (30 Min)', 'price' => 999, 'image' => 'https://desertbuggyrental.com/wp-content/uploads/2024/04/2-Seater-Can-Am-Dune-Buggy.webp'],
                '1_hour' => ['name' => '2 Seater Can-Am Maverick X3 (1 Hour)', 'price' => 1499, 'image' => 'https://desertbuggyrental.com/wp-content/uploads/2024/04/2-Seater-Can-Am-Dune-Buggy.webp'],
                '2_hour' => ['name' => '2 Seater Can-Am Maverick X3 (2 Hours)', 'price' => 2800, 'image' => 'https://desertbuggyrental.com/wp-content/uploads/2024/04/2-Seater-Can-Am-Dune-Buggy.webp']
            ],
            // Can-Am 2 Seater Turbo
            'canam_2_seater_turbo_duration' => [
                '30_min' => ['name' => '2 Seater Can-Am Maverick X3 RS TURBO RR (30 Min)', 'price' => 1200, 'image' => 'https://desertbuggyrental.com/wp-content/uploads/2024/04/2seaterMaverick_X_rs_Turbo.webp'],
                '1_hour' => ['name' => '2 Seater Can-Am Maverick X3 RS TURBO RR (1 Hour)', 'price' => 2300, 'image' => 'https://desertbuggyrental.com/wp-content/uploads/2024/04/2seaterMaverick_X_rs_Turbo.webp'],
                '2_hour' => ['name' => '2 Seater Can-Am Maverick X3 RS TURBO RR (2 Hours)', 'price' => 4200, 'image' => 'https://desertbuggyrental.com/wp-content/uploads/2024/04/2seaterMaverick_X_rs_Turbo.webp']
            ],
            // Can-Am 4 Seater
            'canam_4_seater_duration' => [
                '30_min' => ['name' => '4 Seater Can-Am Maverick X3 (30 Min)', 'price' => 1200, 'image' => 'https://desertbuggyrental.com/wp-content/uploads/2024/04/4-seater-can-am.webp'],
                '1_hour' => ['name' => '4 Seater Can-Am Maverick X3 (1 Hour)', 'price' => 1950, 'image' => 'https://desertbuggyrental.com/wp-content/uploads/2024/04/4-seater-can-am.webp'],
                '2_hour' => ['name' => '4 Seater Can-Am Maverick X3 (2 Hours)', 'price' => 3800, 'image' => 'https://desertbuggyrental.com/wp-content/uploads/2024/04/4-seater-can-am.webp']
            ],
            // Can-Am 4 Seater Turbo
            'canam_4_seater_turbo_duration' => [
                '30_min' => ['name' => '4 Seater Can-Am Maverick X3 RS TURBO RR (30 Min)', 'price' => 1400, 'image' => 'https://desertbuggyrental.com/wp-content/uploads/2024/04/4-Seater-Can-Am-Dune-Buggy-TURBO-RR.webp'],
                '1_hour' => ['name' => '4 Seater Can-Am Maverick X3 RS TURBO RR (1 Hour)', 'price' => 2700, 'image' => 'https://desertbuggyrental.com/wp-content/uploads/2024/04/4-Seater-Can-Am-Dune-Buggy-TURBO-RR.webp'],
                '2_hour' => ['name' => '4 Seater Can-Am Maverick X3 RS TURBO RR (2 Hours)', 'price' => 4200, 'image' => 'https://desertbuggyrental.com/wp-content/uploads/2024/04/4-Seater-Can-Am-Dune-Buggy-TURBO-RR.webp']
            ],
            // Quad Bikes - Kymco Single Seater
            'quad_kymco_single_duration' => [
                '30_min' => ['name' => 'Kymco Single Seater Quad Bike (30 Min)', 'price' => 250, 'image' => 'https://desertbuggyrental.com/wp-content/uploads/2024/04/Desert-Quad-Bike-400-CC-Single-Seater.webp'],
                '1_hour' => ['name' => 'Kymco Single Seater Quad Bike (1 Hour)', 'price' => 350, 'image' => 'https://desertbuggyrental.com/wp-content/uploads/2024/04/Desert-Quad-Bike-400-CC-Single-Seater.webp'],
                '2_hour' => ['name' => 'Kymco Single Seater Quad Bike (2 Hours)', 'price' => 600, 'image' => 'https://desertbuggyrental.com/wp-content/uploads/2024/04/Desert-Quad-Bike-400-CC-Single-Seater.webp']
            ],
            // Quad Bikes - COBRA Single Seater
            'quad_cobra_single_duration' => [
                '30_min' => ['name' => 'COBRA Single Seater Quad Bike (30 Min)', 'price' => 200, 'image' => 'https://desertbuggyrental.com/wp-content/uploads/2024/04/220cc.webp'],
                '1_hour' => ['name' => 'COBRA Single Seater Quad Bike (1 Hour)', 'price' => 250, 'image' => 'https://desertbuggyrental.com/wp-content/uploads/2024/04/220cc.webp'],
                '2_hour' => ['name' => 'COBRA Single Seater Quad Bike (2 Hours)', 'price' => 400, 'image' => 'https://desertbuggyrental.com/wp-content/uploads/2024/04/220cc.webp']
            ],
            // Quad Bikes - Double Seater
            'quad_double_duration' => [
                '30_min' => ['name' => 'Double Seater Quad Bike (30 Min)', 'price' => 350, 'image' => 'https://desertbuggyrental.com/wp-content/uploads/2024/04/Desert-Quad-Bike-400-CC-Double-Seater.webp'],
                '1_hour' => ['name' => 'Double Seater Quad Bike (1 Hour)', 'price' => 450, 'image' => 'https://desertbuggyrental.com/wp-content/uploads/2024/04/Desert-Quad-Bike-400-CC-Double-Seater.webp'],
                '2_hour' => ['name' => 'Double Seater Quad Bike (2 Hours)', 'price' => 800, 'image' => 'https://desertbuggyrental.com/wp-content/uploads/2024/04/Desert-Quad-Bike-400-CC-Double-Seater.webp']
            ],
            // Quad Bikes - SHARMAX Single Seater
            'quad_sharmax_single_duration' => [
                '30_min' => ['name' => 'SHARMAX Quad Bike Single Seater (30 Min)', 'price' => 225, 'image' => 'https://desertbuggyrental.com/wp-content/uploads/2024/04/Single-Seater_sharmax-hammer-320-atv-quad-bike-scaled.jpg'],
                '1_hour' => ['name' => 'SHARMAX Quad Bike Single Seater (1 Hour)', 'price' => 300, 'image' => 'https://desertbuggyrental.com/wp-content/uploads/2024/04/Single-Seater_sharmax-hammer-320-atv-quad-bike-scaled.jpg'],
                '2_hour' => ['name' => 'SHARMAX Quad Bike Single Seater (2 Hours)', 'price' => 550, 'image' => 'https://desertbuggyrental.com/wp-content/uploads/2024/04/Single-Seater_sharmax-hammer-320-atv-quad-bike-scaled.jpg']
            ],
            // Quad Bikes - Yamaha
            'quad_yamaha_duration' => [
                '30_min' => ['name' => 'Yamaha Quad Bike (30 Min)', 'price' => 350, 'image' => 'https://desertbuggyrental.com/wp-content/uploads/2024/04/grizzlythumbnail.webp'],
                '1_hour' => ['name' => 'Yamaha Quad Bike (1 Hour)', 'price' => 450, 'image' => 'https://desertbuggyrental.com/wp-content/uploads/2024/04/grizzlythumbnail.webp'],
                '2_hour' => ['name' => 'Yamaha Quad Bike (2 Hours)', 'price' => 800, 'image' => 'https://desertbuggyrental.com/wp-content/uploads/2024/04/grizzlythumbnail.webp']
            ],
            // Quad Bikes - Sports Single Seater
            'quad_sports_single_duration' => [
                '1_hour' => ['name' => 'Single Seater Sports Quad Bike (1 Hour)', 'price' => 700, 'image' => 'https://desertbuggyrental.com/wp-content/uploads/2024/04/Sport-Quad-Bike-625-CC.webp'],
                '2_hour' => ['name' => 'Single Seater Sports Quad Bike (2 Hours)', 'price' => 1250, 'image' => 'https://desertbuggyrental.com/wp-content/uploads/2024/04/Sport-Quad-Bike-625-CC.webp']
            ],
            // Quad Bikes - Raptor 700
            'quad_raptor_700_duration' => [
                '1_hour' => ['name' => 'Quad Bike Raptor Manual 700 CC (1 Hour)', 'price' => 795, 'image' => 'https://desertbuggyrental.com/wp-content/uploads/2024/04/Yamaha-Raptor-700cc-ATV-Desert-Drive-Dubai.webp'],
                '2_hour' => ['name' => 'Quad Bike Raptor Manual 700 CC (2 Hours)', 'price' => 1550, 'image' => 'https://desertbuggyrental.com/wp-content/uploads/2024/04/Yamaha-Raptor-700cc-ATV-Desert-Drive-Dubai.webp']
            ],
            // Quad Bikes - Kids Single Seater
            'quad_kids_single_duration' => [
                '30_min' => ['name' => 'Kids Quad Bike Single Seater (30 Min)', 'price' => 150, 'image' => 'https://desertbuggyrental.com/wp-content/uploads/2024/04/Desert-Quad-Bike-90-CC-Single-Seater.webp'],
                '1_hour' => ['name' => 'Kids Quad Bike Single Seater (1 Hour)', 'price' => 250, 'image' => 'https://desertbuggyrental.com/wp-content/uploads/2024/04/Desert-Quad-Bike-90-CC-Single-Seater.webp'],
                '2_hour' => ['name' => 'Kids Quad Bike Single Seater (2 Hours)', 'price' => 400, 'image' => 'https://desertbuggyrental.com/wp-content/uploads/2024/04/Desert-Quad-Bike-90-CC-Single-Seater.webp']
            ],
            // Jet Ski
            'jet_ski_duration' => [
                '30_min' => ['name' => 'Jet Ski (30 Min)', 'price' => 350, 'image' => 'https://desertbuggyrental.com/wp-content/uploads/2024/04/jetski.webp'],
                '1_hour' => ['name' => 'Jet Ski (1 Hour)', 'price' => 650, 'image' => 'https://desertbuggyrental.com/wp-content/uploads/2024/04/jetski.webp'],
                '2_hour' => ['name' => 'Jet Ski (2 Hours)', 'price' => 850, 'image' => 'https://desertbuggyrental.com/wp-content/uploads/2024/04/jetski.webp']
            ],
            // Jet Car
            'jet_car_duration' => [
                '30_min' => ['name' => '2 Seater Jet Car (30 Min)', 'price' => 750, 'image' => 'https://desertbuggyrental.com/wp-content/uploads/2024/04/2seaternewjetcardubai.webp'],
                '1_hour' => ['name' => '2 Seater Jet Car (1 Hour)', 'price' => 950, 'image' => 'https://desertbuggyrental.com/wp-content/uploads/2024/04/2seaternewjetcardubai.webp'],
                '2_hour' => ['name' => '2 Seater Jet Car (2 Hours)', 'price' => 1650, 'image' => 'https://desertbuggyrental.com/wp-content/uploads/2024/04/2seaternewjetcardubai.webp']
            ],
            // Camel Ride
            'camel_ride_duration' => [
                'no_of_persons' => ['name' => 'Camel Ride (20-25 Min)', 'price' => 150, 'image' => 'https://desertbuggyrental.com/wp-content/uploads/2024/04/c11.webp']
            ],
            // Sandboarding
            'sandboarding_duration' => [
                'no_of_persons' => ['name' => 'Sandboarding', 'price' => 50, 'image' => 'https://desertbuggyrental.com/wp-content/uploads/2024/04/sandboarding.webp']
            ],
            // Transfer options
            'transfer_option' => [
                'private_transfer' => ['name' => 'Private Transfer', 'price' => 450, 'image' => 'https://desertbuggyrental.com/wp-content/uploads/2024/04/pickupdropoff.webp'],
                'sharing_transfer' => ['name' => 'Sharing Transfer', 'price' => 175, 'image' => 'https://desertbuggyrental.com/wp-content/uploads/2024/04/pickupdropoff.webp']
            ],
            // BBQ Dinner options
            'standard_camp_duration' => [
                'no_of_persons' => ['name' => 'Standard Camp BBQ Dinner', 'price' => 125, 'image' => 'https://desertbuggyrental.com/wp-content/uploads/2024/04/standardcamp.webp']
            ],
            'premium_camp_duration' => [
                'no_of_persons' => ['name' => 'Premium Camp BBQ Dinner', 'price' => 250, 'image' => 'https://desertbuggyrental.com/wp-content/uploads/2024/04/premiumcamp.webp']
            ]
        ];

        // Loop through all possible package types
        foreach ($packageTypes as $packageType => $options) {
            if ($request->has($packageType)) {
                $selectedOption = $request->input($packageType);

                if (isset($options[$selectedOption])) {
                    $item = $options[$selectedOption];
                    $quantityKey = $packageType . '_' . $selectedOption . '_quantity';

                    // Get quantity if available, default to 1
                    $quantity = $request->has($quantityKey) ? $request->input($quantityKey) : 1;

                    // Calculate price based on quantity
                    $price = $item['price'] * $quantity;

                    $selectedItems[] = [
                        'name' => $item['name'],
                        'price' => $price,
                        'quantity' => $quantity,
                        'unit_price' => $item['price'],
                        'image_url' => $item['image'] ?? null
                    ];
                }
            }
        }

        return $selectedItems;
    }

    /**
     * Calculate the total price of selected items.
     *
     * @param  array  $selectedItems
     * @return float
     */
    private function calculateTotalPrice($selectedItems)
    {
        $total = 0;

        foreach ($selectedItems as $item) {
            $total += $item['price'];
        }

        return $total;
    }
}
