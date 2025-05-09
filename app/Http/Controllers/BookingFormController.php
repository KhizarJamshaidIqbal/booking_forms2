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
                '1_hour' => ['name' => 'KTM Dirt Bike 450 CC (1 Hour)', 'price' => 850],
                '2_hour' => ['name' => 'KTM Dirt Bike 450 CC (2 Hours)', 'price' => 1250],
                '3_hour' => ['name' => 'KTM Dirt Bike 450 CC (3 Hours)', 'price' => 1450]
            ],
            // Buggy 2 Seater
            'buggy_2_seater_duration' => [
                '30_min' => ['name' => '2 Seater Polaris Dune Buggy (30 Min)', 'price' => 600],
                '1_hour' => ['name' => '2 Seater Polaris Dune Buggy (1 Hour)', 'price' => 900],
                '2_hour' => ['name' => '2 Seater Polaris Dune Buggy (2 Hours)', 'price' => 1750]
            ],
            // Buggy 2 Seater Turbo
            'buggy_2_seater_turbo_duration' => [
                '30_min' => ['name' => '2 Seater Polaris Dune Buggy Turbo (30 Min)', 'price' => 900],
                '1_hour' => ['name' => '2 Seater Polaris Dune Buggy Turbo (1 Hour)', 'price' => 1200],
                '2_hour' => ['name' => '2 Seater Polaris Dune Buggy Turbo (2 Hours)', 'price' => 2200]
            ],
            // Buggy 4 Seater
            'buggy_4_seater_duration' => [
                '30_min' => ['name' => '4 Seater Polaris Dune Buggy (30 Min)', 'price' => 800],
                '1_hour' => ['name' => '4 Seater Polaris Dune Buggy (1 Hour)', 'price' => 1200],
                '2_hour' => ['name' => '4 Seater Polaris Dune Buggy (2 Hours)', 'price' => 2200]
            ],
            // Can-Am 2 Seater
            'canam_2_seater_duration' => [
                '30_min' => ['name' => '2 Seater Can-Am Maverick X3 (30 Min)', 'price' => 999],
                '1_hour' => ['name' => '2 Seater Can-Am Maverick X3 (1 Hour)', 'price' => 1499],
                '2_hour' => ['name' => '2 Seater Can-Am Maverick X3 (2 Hours)', 'price' => 2800]
            ],
            // Quad Bikes (various types)
            'quad_kymco_single_duration' => [
                '30_min' => ['name' => 'Kymco Single Seater Quad Bike (30 Min)', 'price' => 250],
                '1_hour' => ['name' => 'Kymco Single Seater Quad Bike (1 Hour)', 'price' => 350],
                '2_hour' => ['name' => 'Kymco Single Seater Quad Bike (2 Hours)', 'price' => 600]
            ],
            // Jet Ski
            'jet_ski_duration' => [
                '30_min' => ['name' => 'Jet Ski (30 Min)', 'price' => 350],
                '1_hour' => ['name' => 'Jet Ski (1 Hour)', 'price' => 650],
                '2_hour' => ['name' => 'Jet Ski (2 Hours)', 'price' => 850]
            ],
            // Camel Ride
            'camel_ride_duration' => [
                'no_of_persons' => ['name' => 'Camel Ride (20-25 Min)', 'price' => 150]
            ],
            // Sandboarding
            'sandboarding_duration' => [
                'no_of_persons' => ['name' => 'Sandboarding', 'price' => 50]
            ],
            // Transfer options
            'transfer_option' => [
                'private_transfer' => ['name' => 'Private Transfer', 'price' => 450],
                'sharing_transfer' => ['name' => 'Sharing Transfer', 'price' => 175]
            ],
            // BBQ Dinner options
            'standard_camp_duration' => [
                'no_of_persons' => ['name' => 'Standard Camp BBQ Dinner', 'price' => 125]
            ],
            'premium_camp_duration' => [
                'no_of_persons' => ['name' => 'Premium Camp BBQ Dinner', 'price' => 250]
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
                        'unit_price' => $item['price']
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
