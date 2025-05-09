<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desert Excursion Activities</title>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        /* Global styles */
        [x-cloak] { display: none !important; }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f8f8;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
        }
        .important-note {
            color: red;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .note-content {
            padding-left: 20px;
        }
        .note-content li {
            margin-bottom: 5px;
        }
        .comments-area {
            width: 100%;
            min-height: 100px;
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 10px;
            box-sizing: border-box;
        }
        .char-count {
            text-align: right;
            font-size: 12px;
            color: #666;
            margin-top: 5px;
        }
        .final-total {
            text-align: right;
            margin-top: 20px;
            padding: 15px;
            background-color: #f5f5f5;
            border-radius: 8px;
        }
        .final-total .label {
            font-size: 18px;
            color: red;
            font-weight: bold;
        }
        .final-total .amount {
            font-size: 24px;
            font-weight: bold;
        }
        .select-package h3 {
            margin-bottom: 20px;
            font-size: 20px;
            color: #333;
        }
        /* Ride options style */
        .ride-options {
            padding: 10px 0;
            margin-top: 5px;
            margin-bottom: 15px;
            border-bottom: none;
        }
        /* Package options styling */
        .package-container {
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 15px;
            background-color: white;
            padding: 15px;
        }
        .package-container.selected {
            border-color: #15BFBF;
            border-width: 2px;
        }
        /* Checkbox toggle styling */
        .toggle-switch {
            width: 50px;
            height: 25px;
            background-color: #f5f5f5;
            border: 2px solid #ddd;
            border-radius: 3px;
            position: relative;
            cursor: pointer;
            overflow: hidden;
            display: flex;
            align-items: center;
        }
        .toggle-slider {
            position: absolute;
            width: 25px;
            height: 21px;
            background-color: white;
            border-right: 1px solid #ddd;
            left: 0;
            top: 0;
            bottom: 0;
            margin: auto 0;
            transition: all 0.2s ease;
        }
        .toggle-switch.active {
            background-color: #15BFBF;
            border-color: #15BFBF;
        }
        .toggle-switch.active .toggle-slider {
            transform: translateX(25px);
            border-left: 1px solid rgba(255,255,255,0.3);
            border-right: none;
        }
        .package-title {
            font-weight: 500;
            font-size: 15px;
        }
        .package-title.selected {
            font-weight: bold;
        }
        /* Quantity control styling */
        .quantity-control-wrapper {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            margin-top: 8px;
        }
        /* Custom submit button */
        .submit-btn {
            background-color: #15BFBF;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        .submit-btn:hover {
            background-color: #14adad;
        }
        /* Section styling to match images */
        .form-section {
            margin-bottom: 15px;
        }
        .form-section-header {
            background-color: #15BFBF;
            color: white;
            padding: 10px 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }
        .form-section-header h2 {
            margin: 0;
            font-size: 16px;
            font-weight: 600;
        }
        .form-section-content {
            background-color: white;
            padding: 15px;
            border: 1px solid #ddd;
            border-top: none;
            border-bottom-left-radius: 5px;
            border-bottom-right-radius: 5px;
        }
        /* Divider line for each ride option */
        .radio-item {
            border-bottom: none;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }
        .radio-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }
        .quantity-label {
            margin-left: 5px;
            font-size: 13px;
            color: #666;
        }

        /* Form control styling */
        .form-control {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .required-field::after {
            content: "*";
            color: red;
            margin-left: 4px;
        }

        .mt-2 {
            margin-top: 8px;
        }

        .mt-3 {
            margin-top: 12px;
        }
    </style>
</head>
<body>

<div class="container">
    <x-form title="Desert Excursion Activities" submitButtonText="Book Now" action="{{ route('desert-excursion.submit') }}" method="POST" x-data="formCalculations()">
        @csrf

        <x-form-input
            type="date"
            name="date"
            label="Select Date"
            required="true"
        />

        <div class="form-group">
            <p>Preferred Time<br>
            We open every day from 5:00 am to 8:00 pm</p>
        </div>

        <x-form-select
            name="time_slot"
            label="Select Your Excursion Time Slot"
            required="true"
            :options="[
                '5:00 am' => '5:00 am',
                '6:00 am' => '6:00 am',
                '7:00 am' => '7:00 am',
                '8:00 am' => '8:00 am',
                '9:00 am' => '9:00 am',
                '10:00 am' => '10:00 am',
                '11:00 am' => '11:00 am',
                '12:00 pm' => '12:00 pm',
                '1:00 pm' => '1:00 pm',
                '2:00 pm' => '2:00 pm',
                '3:00 pm' => '3:00 pm',
                '4:00 pm' => '4:00 pm',
                '5:00 pm' => '5:00 pm',
                '6:00 pm' => '6:00 pm',
                '7:00 pm' => '7:00 pm',
                '8:00 pm' => '8:00 pm'
            ]"
        />

        <div class="select-package">
            <h3>Select Package</h3>

            <x-form-section title="KTM Dirt Bike" :initialOpen="true">
                <div x-data="{ isSelected: false }">
                    <div class="package-container" :class="{ 'selected': isSelected }">
                        <div style="display: flex; align-items: center;">
                            <div class="toggle-switch"
                                 :class="{ 'active': isSelected }"
                                 @click="isSelected = !isSelected;
                                         window.dispatchEvent(new CustomEvent('package-toggle', {
                                             detail: { package: 'ktm_dirt_bike', active: isSelected }
                                         }));">
                                <div class="toggle-slider"></div>
                            </div>
                            <div style="display: flex; margin-left: 15px; align-items: center;">
                                <img src="https://desertbuggyrental.com/wp-content/uploads/2024/04/motocross-hire-in-dubai.webp"
                                     style="width: 60px; height: 50px; object-fit: cover; margin-right: 15px; border-radius: 4px;">
                                <span class="package-title" :class="{ 'selected': isSelected }">KTM Dirt Bike 450 CC</span>
                            </div>
                        </div>
                    </div>

                    <div class="ride-options" x-show="isSelected" x-transition>
                    <x-form-radio
                        name="dirt_bike_duration"
                        label="1 Hour Ride"
                        value="1_hour"
                        price="850"
                        quantityLabel="No of Dirt Bikes"
                            x-on:change="calculateTotal"
                    />

                    <x-form-radio
                        name="dirt_bike_duration"
                        label="2 Hour Ride"
                        value="2_hour"
                        price="1250"
                        quantityLabel="No of Dirt Bikes"
                            x-on:change="calculateTotal"
                    />

                    <x-form-radio
                        name="dirt_bike_duration"
                        label="3 Hour Ride"
                        value="3_hour"
                        price="1450"
                        quantityLabel="No of Dirt Bikes"
                            x-on:change="calculateTotal"
                    />
                    </div>
                </div>
            </x-form-section>

            <x-form-section title="Dune Buggy">
                <div x-data="{ options: { 'buggy_2_seater': false, 'buggy_2_seater_turbo': false, 'buggy_4_seater': false } }">
                    <div class="package-container" :class="{ 'selected': options.buggy_2_seater }">
                        <div style="display: flex; align-items: center;">
                            <div class="toggle-switch"
                                 :class="{ 'active': options.buggy_2_seater }"
                                 @click="options.buggy_2_seater = !options.buggy_2_seater;
                                         window.dispatchEvent(new CustomEvent('package-toggle', {
                                             detail: { package: 'buggy_2_seater', active: options.buggy_2_seater }
                                         }));">
                                <div class="toggle-slider"></div>
                            </div>
                            <div style="display: flex; margin-left: 15px; align-items: center;">
                                <img src="https://desertbuggyrental.com/wp-content/uploads/2024/04/2seaterbuggy.webp"
                                     style="width: 60px; height: 50px; object-fit: cover; margin-right: 15px; border-radius: 4px;">
                                <span class="package-title" :class="{ 'selected': options.buggy_2_seater }">2 Seater Polaris Dune Buggy RZR 1000 CC</span>
                            </div>
                        </div>
                    </div>

                    <div class="ride-options" x-show="options.buggy_2_seater" x-transition>
                    <x-form-radio
                        name="buggy_2_seater_duration"
                        label="30 Min Ride"
                        value="30_min"
                        price="600"
                        quantityLabel="No of Buggies"
                            x-on:change="calculateTotal"
                    />

                    <x-form-radio
                        name="buggy_2_seater_duration"
                        label="1 Hour Ride"
                        value="1_hour"
                        price="900"
                        quantityLabel="No of Buggies"
                            x-on:change="calculateTotal"
                    />

                    <x-form-radio
                        name="buggy_2_seater_duration"
                        label="2 Hour Ride"
                        value="2_hour"
                        price="1750"
                        quantityLabel="No of Buggies"
                            x-on:change="calculateTotal"
                    />
                </div>

                    <div class="package-container" :class="{ 'selected': options.buggy_2_seater_turbo }">
                        <div style="display: flex; align-items: center;">
                            <div class="toggle-switch"
                                 :class="{ 'active': options.buggy_2_seater_turbo }"
                                 @click="options.buggy_2_seater_turbo = !options.buggy_2_seater_turbo;
                                         window.dispatchEvent(new CustomEvent('package-toggle', {
                                             detail: { package: 'buggy_2_seater_turbo', active: options.buggy_2_seater_turbo }
                                         }));">
                                <div class="toggle-slider"></div>
                            </div>
                            <div style="display: flex; margin-left: 15px; align-items: center;">
                                <img src="https://desertbuggyrental.com/wp-content/uploads/2024/04/2seaterbuggyturbo-1.webp"
                                     style="width: 60px; height: 50px; object-fit: cover; margin-right: 15px; border-radius: 4px;">
                                <span class="package-title" :class="{ 'selected': options.buggy_2_seater_turbo }">2 Seater Polaris Dune Buggy RZR 1000 CC Turbo</span>
                            </div>
                        </div>
                    </div>

                    <div class="ride-options" x-show="options.buggy_2_seater_turbo" x-transition>
                    <x-form-radio
                        name="buggy_2_seater_turbo_duration"
                        label="30 Min Ride"
                        value="30_min"
                        price="900"
                        quantityLabel="No of Buggies"
                            x-on:change="calculateTotal"
                    />

                    <x-form-radio
                        name="buggy_2_seater_turbo_duration"
                        label="1 Hour Ride"
                        value="1_hour"
                        price="1200"
                        quantityLabel="No of Buggies"
                            x-on:change="calculateTotal"
                    />

                    <x-form-radio
                        name="buggy_2_seater_turbo_duration"
                        label="2 Hour Ride"
                        value="2_hour"
                        price="2200"
                        quantityLabel="No of Buggies"
                            x-on:change="calculateTotal"
                    />
                </div>

                <div class="package-container" :class="{ 'selected': options.buggy_4_seater }">
                    <div style="display: flex; align-items: center;">
                        <div class="toggle-switch"
                             :class="{ 'active': options.buggy_4_seater }"
                             @click="options.buggy_4_seater = !options.buggy_4_seater;
                                     window.dispatchEvent(new CustomEvent('package-toggle', {
                                         detail: { package: 'buggy_4_seater', active: options.buggy_4_seater }
                                     }));">
                            <div class="toggle-slider"></div>
                        </div>
                        <div style="display: flex; margin-left: 15px; align-items: center;">
                            <img src="https://desertbuggyrental.com/wp-content/uploads/2024/04/4seaterbuggy.webp"
                                 style="width: 60px; height: 50px; object-fit: cover; margin-right: 15px; border-radius: 4px;">
                            <span class="package-title" :class="{ 'selected': options.buggy_4_seater }">4 Seater Polaris Dune Buggy RZR 1000 CC</span>
                        </div>
                    </div>
                </div>

                <div class="ride-options" x-show="options.buggy_4_seater" x-transition>
                    <x-form-radio
                        name="buggy_4_seater_duration"
                        label="30 Min Ride"
                        value="30_min"
                        price="800"
                        quantityLabel="No of Buggies"
                        x-on:change="calculateTotal"
                    />

                    <x-form-radio
                        name="buggy_4_seater_duration"
                        label="1 Hour Ride"
                        value="1_hour"
                        price="1200"
                        quantityLabel="No of Buggies"
                        x-on:change="calculateTotal"
                    />

                    <x-form-radio
                        name="buggy_4_seater_duration"
                        label="2 Hour Ride"
                        value="2_hour"
                        price="2200"
                        quantityLabel="No of Buggies"
                        x-on:change="calculateTotal"
                    />
                </div>

                <div class="package-container" :class="{ 'selected': options.buggy_4_seater_turbo }">
                    <div style="display: flex; align-items: center;">
                        <div class="toggle-switch"
                             :class="{ 'active': options.buggy_4_seater_turbo }"
                             @click="options.buggy_4_seater_turbo = !options.buggy_4_seater_turbo;
                                     window.dispatchEvent(new CustomEvent('package-toggle', {
                                         detail: { package: 'buggy_4_seater_turbo', active: options.buggy_4_seater_turbo }
                                     }));">
                            <div class="toggle-slider"></div>
                        </div>
                        <div style="display: flex; margin-left: 15px; align-items: center;">
                            <img src="https://desertbuggyrental.com/wp-content/uploads/2024/04/4seaterturbo.webp"
                                 style="width: 60px; height: 50px; object-fit: cover; margin-right: 15px; border-radius: 4px;">
                            <span class="package-title" :class="{ 'selected': options.buggy_4_seater_turbo }">4 Seater Polaris Dune Buggy RZR 1000 CC Turbo</span>
                        </div>
                    </div>
                </div>

                <div class="ride-options" x-show="options.buggy_4_seater_turbo" x-transition>
                    <x-form-radio
                        name="buggy_4_seater_turbo_duration"
                        label="30 Min"
                        value="30_min"
                        price="1200"
                        quantityLabel="No of Can Am"
                        x-on:change="calculateTotal"
                    />

                    <x-form-radio
                        name="buggy_4_seater_turbo_duration"
                        label="1 Hour Ride"
                        value="1_hour"
                        price="2150"
                        quantityLabel="No of Can Am"
                        x-on:change="calculateTotal"
                    />

                    <x-form-radio
                        name="buggy_4_seater_turbo_duration"
                        label="2 Hour Ride"
                        value="2_hour"
                        price="3975"
                        quantityLabel="No of Can Am"
                        x-on:change="calculateTotal"
                    />
                </div>

                <div class="package-container" :class="{ 'selected': options.canam_2_seater }">
                    <div style="display: flex; align-items: center;">
                        <div class="toggle-switch"
                             :class="{ 'active': options.canam_2_seater }"
                             @click="options.canam_2_seater = !options.canam_2_seater;
                                     window.dispatchEvent(new CustomEvent('package-toggle', {
                                         detail: { package: 'canam_2_seater', active: options.canam_2_seater }
                                     }));">
                            <div class="toggle-slider"></div>
                        </div>
                        <div style="display: flex; margin-left: 15px; align-items: center;">
                            <img src="https://desertbuggyrental.com/wp-content/uploads/2024/04/2-Seater-Can-Am-Dune-Buggy.webp"
                                 style="width: 60px; height: 50px; object-fit: cover; margin-right: 15px; border-radius: 4px;">
                            <span class="package-title" :class="{ 'selected': options.canam_2_seater }">2 Seater Can-Am Maverick X3</span>
                        </div>
                    </div>
                </div>

                <div class="ride-options" x-show="options.canam_2_seater" x-transition>
                    <x-form-radio
                        name="canam_2_seater_duration"
                        label="30 Min"
                        value="30_min"
                        price="999"
                        quantityLabel="No of Can Am"
                        x-on:change="calculateTotal"
                    />

                    <x-form-radio
                        name="canam_2_seater_duration"
                        label="1 Hour Ride"
                        value="1_hour"
                        price="1499"
                        quantityLabel="No of Can Am"
                        x-on:change="calculateTotal"
                    />

                    <x-form-radio
                        name="canam_2_seater_duration"
                        label="2 Hour Ride"
                        value="2_hour"
                        price="2800"
                        quantityLabel="No of Can Am"
                        x-on:change="calculateTotal"
                    />
                </div>

                <div class="package-container" :class="{ 'selected': options.canam_2_seater_turbo }">
                    <div style="display: flex; align-items: center;">
                        <div class="toggle-switch"
                             :class="{ 'active': options.canam_2_seater_turbo }"
                             @click="options.canam_2_seater_turbo = !options.canam_2_seater_turbo;
                                     window.dispatchEvent(new CustomEvent('package-toggle', {
                                         detail: { package: 'canam_2_seater_turbo', active: options.canam_2_seater_turbo }
                                     }));">
                            <div class="toggle-slider"></div>
                        </div>
                        <div style="display: flex; margin-left: 15px; align-items: center;">
                            <img src="https://desertbuggyrental.com/wp-content/uploads/2024/04/2seaterMaverick_X_rs_Turbo.webp"
                                 style="width: 60px; height: 50px; object-fit: cover; margin-right: 15px; border-radius: 4px;">
                            <span class="package-title" :class="{ 'selected': options.canam_2_seater_turbo }">2 Seater Can-Am Maverick X3 RS TURBO RR</span>
                        </div>
                    </div>
                </div>

                <div class="ride-options" x-show="options.canam_2_seater_turbo" x-transition>
                    <x-form-radio
                        name="canam_2_seater_turbo_duration"
                        label="30 Min Ride"
                        value="30_min"
                        price="1200"
                        quantityLabel="No of Can Am"
                        x-on:change="calculateTotal"
                    />

                    <x-form-radio
                        name="canam_2_seater_turbo_duration"
                        label="1 Hour Ride"
                        value="1_hour"
                        price="2300"
                        quantityLabel="No of Can Am"
                        x-on:change="calculateTotal"
                    />

                    <x-form-radio
                        name="canam_2_seater_turbo_duration"
                        label="2 Hour Ride"
                        value="2_hour"
                        price="4200"
                        quantityLabel="No of Can Am"
                        x-on:change="calculateTotal"
                    />
                </div>

                <div class="package-container" :class="{ 'selected': options.canam_4_seater }">
                    <div style="display: flex; align-items: center;">
                        <div class="toggle-switch"
                             :class="{ 'active': options.canam_4_seater }"
                             @click="options.canam_4_seater = !options.canam_4_seater;
                                     window.dispatchEvent(new CustomEvent('package-toggle', {
                                         detail: { package: 'canam_4_seater', active: options.canam_4_seater }
                                     }));">
                            <div class="toggle-slider"></div>
                        </div>
                        <div style="display: flex; margin-left: 15px; align-items: center;">
                            <img src="https://desertbuggyrental.com/wp-content/uploads/2024/04/4-seater-can-am.webp"
                                 style="width: 60px; height: 50px; object-fit: cover; margin-right: 15px; border-radius: 4px;">
                            <span class="package-title" :class="{ 'selected': options.canam_4_seater }">4 Seater Can-Am Maverick X3</span>
                        </div>
                    </div>
                </div>

                <div class="ride-options" x-show="options.canam_4_seater" x-transition>
                    <x-form-radio
                        name="canam_4_seater_duration"
                        label="30 Min"
                        value="30_min"
                        price="1200"
                        quantityLabel="No of Can Am"
                        x-on:change="calculateTotal"
                    />

                    <x-form-radio
                        name="canam_4_seater_duration"
                        label="1 Hour Ride"
                        value="1_hour"
                        price="1950"
                        quantityLabel="No of Can Am"
                        x-on:change="calculateTotal"
                    />

                    <x-form-radio
                        name="canam_4_seater_duration"
                        label="2 Hour Ride"
                        value="2_hour"
                        price="3800"
                        quantityLabel="No of Can Am"
                        x-on:change="calculateTotal"
                    />
                </div>

                <div class="package-container" :class="{ 'selected': options.canam_4_seater_turbo }">
                    <div style="display: flex; align-items: center;">
                        <div class="toggle-switch"
                             :class="{ 'active': options.canam_4_seater_turbo }"
                             @click="options.canam_4_seater_turbo = !options.canam_4_seater_turbo;
                                     window.dispatchEvent(new CustomEvent('package-toggle', {
                                         detail: { package: 'canam_4_seater_turbo', active: options.canam_4_seater_turbo }
                                     }));">
                            <div class="toggle-slider"></div>
                        </div>
                        <div style="display: flex; margin-left: 15px; align-items: center;">
                            <img src="https://desertbuggyrental.com/wp-content/uploads/2024/04/4-Seater-Can-Am-Dune-Buggy-TURBO-RR.webp"
                                 style="width: 60px; height: 50px; object-fit: cover; margin-right: 15px; border-radius: 4px;">
                            <span class="package-title" :class="{ 'selected': options.canam_4_seater_turbo }">4 Seater Can-Am Maverick X3 RS TURBO RR</span>
                        </div>
                    </div>
                </div>

                <div class="ride-options" x-show="options.canam_4_seater_turbo" x-transition>
                    <x-form-radio
                        name="canam_4_seater_turbo_duration"
                        label="30 Min"
                        value="30_min"
                        price="1400"
                        quantityLabel="No of Can Am"
                        x-on:change="calculateTotal"
                    />

                    <x-form-radio
                        name="canam_4_seater_turbo_duration"
                        label="1 Hour Ride"
                        value="1_hour"
                        price="2700"
                        quantityLabel="No of Can Am"
                        x-on:change="calculateTotal"
                    />

                    <x-form-radio
                        name="canam_4_seater_turbo_duration"
                        label="2 Hour Ride"
                        value="2_hour"
                        price="4200"
                        quantityLabel="No of Can Am"
                        x-on:change="calculateTotal"
                    />
                </div>
                </div>
            </x-form-section>

            <x-form-section title="Quad Bikes">
            <div x-data="{ options: {
                'quad_kymco_single': false,
                'quad_cobra_single': false,
                'quad_double': false,
                'quad_sharmax_single': false,
                'quad_yamaha': false,
                'quad_sports_single': false,
                'quad_raptor_700': false,
                'quad_kids_single': false
            }}">
                <div class="package-container" :class="{ 'selected': options.quad_kymco_single }">
                    <div style="display: flex; align-items: center;">
                        <div class="toggle-switch"
                             :class="{ 'active': options.quad_kymco_single }"
                             @click="options.quad_kymco_single = !options.quad_kymco_single;
                                     window.dispatchEvent(new CustomEvent('package-toggle', {
                                         detail: { package: 'quad_kymco_single', active: options.quad_kymco_single }
                                     }));">
                            <div class="toggle-slider"></div>
                        </div>
                        <div style="display: flex; margin-left: 15px; align-items: center;">
                            <img src="https://desertbuggyrental.com/wp-content/uploads/2024/04/Desert-Quad-Bike-400-CC-Single-Seater.webp"
                                 style="width: 60px; height: 50px; object-fit: cover; margin-right: 15px; border-radius: 4px;">
                            <span class="package-title" :class="{ 'selected': options.quad_kymco_single }">Kymco Single Seater Quad Bike ( Open Deep Desert )</span>
                        </div>
                    </div>
                </div>

                <div class="ride-options" x-show="options.quad_kymco_single" x-transition>
                    <x-form-radio
                        name="quad_kymco_single_duration"
                        label="30 Min"
                        value="30_min"
                        price="250"
                        quantityLabel="No of Quad Bikes"
                        x-on:change="calculateTotal"
                    />

                    <x-form-radio
                        name="quad_kymco_single_duration"
                        label="1 Hour Ride"
                        value="1_hour"
                        price="350"
                        quantityLabel="No of Quad Bikes"
                        x-on:change="calculateTotal"
                    />

                    <x-form-radio
                        name="quad_kymco_single_duration"
                        label="2 Hour Ride"
                        value="2_hour"
                        price="600"
                        quantityLabel="No of Quad Bikes"
                        x-on:change="calculateTotal"
                    />
                </div>

                <div class="package-container" :class="{ 'selected': options.quad_cobra_single }">
                    <div style="display: flex; align-items: center;">
                        <div class="toggle-switch"
                             :class="{ 'active': options.quad_cobra_single }"
                             @click="options.quad_cobra_single = !options.quad_cobra_single;
                                     window.dispatchEvent(new CustomEvent('package-toggle', {
                                         detail: { package: 'quad_cobra_single', active: options.quad_cobra_single }
                                     }));">
                            <div class="toggle-slider"></div>
                        </div>
                        <div style="display: flex; margin-left: 15px; align-items: center;">
                            <img src="https://desertbuggyrental.com/wp-content/uploads/2024/04/220cc.webp"
                                 style="width: 60px; height: 50px; object-fit: cover; margin-right: 15px; border-radius: 4px;">
                            <span class="package-title" :class="{ 'selected': options.quad_cobra_single }">COBRA Single Seater Quad Bike ( Fenced Area )</span>
                        </div>
                    </div>
                </div>

                <div class="ride-options" x-show="options.quad_cobra_single" x-transition>
                    <x-form-radio
                        name="quad_cobra_single_duration"
                        label="30 Min"
                        value="30_min"
                        price="200"
                        quantityLabel="No of Quad Bikes"
                        x-on:change="calculateTotal"
                    />

                    <x-form-radio
                        name="quad_cobra_single_duration"
                        label="1 Hour Ride"
                        value="1_hour"
                        price="250"
                        quantityLabel="No of Quad Bikes"
                        x-on:change="calculateTotal"
                    />

                    <x-form-radio
                        name="quad_cobra_single_duration"
                        label="2 Hour Ride"
                        value="2_hour"
                        price="400"
                        quantityLabel="No of Quad Bikes"
                        x-on:change="calculateTotal"
                    />
                </div>

                <div class="package-container" :class="{ 'selected': options.quad_double }">
                    <div style="display: flex; align-items: center;">
                        <div class="toggle-switch"
                             :class="{ 'active': options.quad_double }"
                             @click="options.quad_double = !options.quad_double;
                                     window.dispatchEvent(new CustomEvent('package-toggle', {
                                         detail: { package: 'quad_double', active: options.quad_double }
                                     }));">
                            <div class="toggle-slider"></div>
                        </div>
                        <div style="display: flex; margin-left: 15px; align-items: center;">
                            <img src="https://desertbuggyrental.com/wp-content/uploads/2024/04/Desert-Quad-Bike-400-CC-Double-Seater.webp"
                                 style="width: 60px; height: 50px; object-fit: cover; margin-right: 15px; border-radius: 4px;">
                            <span class="package-title" :class="{ 'selected': options.quad_double }">Double Seater Quad Bike ( Open Deep Desert )</span>
                        </div>
                    </div>
                </div>

                <div class="ride-options" x-show="options.quad_double" x-transition>
                    <x-form-radio
                        name="quad_double_duration"
                        label="30 Min"
                        value="30_min"
                        price="350"
                        quantityLabel="No of Quad Bikes"
                        x-on:change="calculateTotal"
                    />

                    <x-form-radio
                        name="quad_double_duration"
                        label="1 Hour Ride"
                        value="1_hour"
                        price="450"
                        quantityLabel="No of Quad Bikes"
                        x-on:change="calculateTotal"
                    />

                    <x-form-radio
                        name="quad_double_duration"
                        label="2 Hour Ride"
                        value="2_hour"
                        price="800"
                        quantityLabel="No of Quad Bikes"
                        x-on:change="calculateTotal"
                    />
                </div>

                <div class="package-container" :class="{ 'selected': options.quad_sharmax_single }">
                    <div style="display: flex; align-items: center;">
                        <div class="toggle-switch"
                             :class="{ 'active': options.quad_sharmax_single }"
                             @click="options.quad_sharmax_single = !options.quad_sharmax_single;
                                     window.dispatchEvent(new CustomEvent('package-toggle', {
                                         detail: { package: 'quad_sharmax_single', active: options.quad_sharmax_single }
                                     }));">
                            <div class="toggle-slider"></div>
                        </div>
                        <div style="display: flex; margin-left: 15px; align-items: center;">
                            <img src="https://desertbuggyrental.com/wp-content/uploads/2024/04/Single-Seater_sharmax-hammer-320-atv-quad-bike-scaled.jpg"
                                 style="width: 60px; height: 50px; object-fit: cover; margin-right: 15px; border-radius: 4px;">
                            <span class="package-title" :class="{ 'selected': options.quad_sharmax_single }">SHARMAX Quad Bike Single Seater (Fenced Area)</span>
                        </div>
                    </div>
                </div>

                <div class="ride-options" x-show="options.quad_sharmax_single" x-transition>
                    <x-form-radio
                        name="quad_sharmax_single_duration"
                        label="30 Min"
                        value="30_min"
                        price="225"
                        quantityLabel="No of Quad Bikes"
                        x-on:change="calculateTotal"
                    />

                    <x-form-radio
                        name="quad_sharmax_single_duration"
                        label="1 Hour Ride"
                        value="1_hour"
                        price="300"
                        quantityLabel="No of Quad Bikes"
                        x-on:change="calculateTotal"
                    />

                    <x-form-radio
                        name="quad_sharmax_single_duration"
                        label="2 Hour Ride"
                        value="2_hour"
                        price="550"
                        quantityLabel="No of Quad Bikes"
                        x-on:change="calculateTotal"
                    />
                </div>

                <div class="package-container" :class="{ 'selected': options.quad_yamaha }">
                    <div style="display: flex; align-items: center;">
                        <div class="toggle-switch"
                             :class="{ 'active': options.quad_yamaha }"
                             @click="options.quad_yamaha = !options.quad_yamaha;
                                     window.dispatchEvent(new CustomEvent('package-toggle', {
                                         detail: { package: 'quad_yamaha', active: options.quad_yamaha }
                                     }));">
                            <div class="toggle-slider"></div>
                        </div>
                        <div style="display: flex; margin-left: 15px; align-items: center;">
                            <img src="https://desertbuggyrental.com/wp-content/uploads/2024/04/grizzlythumbnail.webp"
                                 style="width: 60px; height: 50px; object-fit: cover; margin-right: 15px; border-radius: 4px;">
                            <span class="package-title" :class="{ 'selected': options.quad_yamaha }">Yamaha Quad Bike (Open Deep Desert Area)</span>
                        </div>
                    </div>
                </div>

                <div class="ride-options" x-show="options.quad_yamaha" x-transition>
                    <x-form-radio
                        name="quad_yamaha_duration"
                        label="30 Min"
                        value="30_min"
                        price="350"
                        quantityLabel="No of Quad Bikes"
                        x-on:change="calculateTotal"
                    />

                    <x-form-radio
                        name="quad_yamaha_duration"
                        label="1 Hour Ride"
                        value="1_hour"
                        price="450"
                        quantityLabel="No of Quad Bikes"
                        x-on:change="calculateTotal"
                    />

                    <x-form-radio
                        name="quad_yamaha_duration"
                        label="2 Hour Ride"
                        value="2_hour"
                        price="800"
                        quantityLabel="No of Quad Bikes"
                        x-on:change="calculateTotal"
                    />
                </div>

                <div class="package-container" :class="{ 'selected': options.quad_sports_single }">
                    <div style="display: flex; align-items: center;">
                        <div class="toggle-switch"
                             :class="{ 'active': options.quad_sports_single }"
                             @click="options.quad_sports_single = !options.quad_sports_single;
                                     window.dispatchEvent(new CustomEvent('package-toggle', {
                                         detail: { package: 'quad_sports_single', active: options.quad_sports_single }
                                     }));">
                            <div class="toggle-slider"></div>
                        </div>
                        <div style="display: flex; margin-left: 15px; align-items: center;">
                            <img src="https://desertbuggyrental.com/wp-content/uploads/2024/04/Sport-Quad-Bike-625-CC.webp"
                                 style="width: 60px; height: 50px; object-fit: cover; margin-right: 15px; border-radius: 4px;">
                            <span class="package-title" :class="{ 'selected': options.quad_sports_single }">Single Seater Sports Quad Bike (open deep desert)</span>
                        </div>
                    </div>
                </div>

                <div class="ride-options" x-show="options.quad_sports_single" x-transition>
                    <x-form-radio
                        name="quad_sports_single_duration"
                        label="1 Hour Ride"
                        value="1_hour"
                        price="700"
                        quantityLabel="No of Quad Bikes"
                        x-on:change="calculateTotal"
                    />

                    <x-form-radio
                        name="quad_sports_single_duration"
                        label="2 Hour Ride"
                        value="2_hour"
                        price="1250"
                        quantityLabel="No of Quad Bikes"
                        x-on:change="calculateTotal"
                    />
                </div>

                <div class="package-container" :class="{ 'selected': options.quad_raptor_700 }">
                    <div style="display: flex; align-items: center;">
                        <div class="toggle-switch"
                             :class="{ 'active': options.quad_raptor_700 }"
                             @click="options.quad_raptor_700 = !options.quad_raptor_700;
                                     window.dispatchEvent(new CustomEvent('package-toggle', {
                                         detail: { package: 'quad_raptor_700', active: options.quad_raptor_700 }
                                     }));">
                            <div class="toggle-slider"></div>
                        </div>
                        <div style="display: flex; margin-left: 15px; align-items: center;">
                            <img src="https://desertbuggyrental.com/wp-content/uploads/2024/04/Yamaha-Raptor-700cc-ATV-Desert-Drive-Dubai.webp"
                                 style="width: 60px; height: 50px; object-fit: cover; margin-right: 15px; border-radius: 4px;">
                            <span class="package-title" :class="{ 'selected': options.quad_raptor_700 }">Quad Bike Raptor Manual 700 CC ( Open Deep Desert )</span>
                        </div>
                    </div>
                </div>

                <div class="ride-options" x-show="options.quad_raptor_700" x-transition>
                    <x-form-radio
                        name="quad_raptor_700_duration"
                        label="1 Hour Ride"
                        value="1_hour"
                        price="795"
                        quantityLabel="No of Quad Bikes"
                        x-on:change="calculateTotal"
                    />

                    <x-form-radio
                        name="quad_raptor_700_duration"
                        label="2 Hour Ride"
                        value="2_hour"
                        price="1550"
                        quantityLabel="No of Quad Bikes"
                        x-on:change="calculateTotal"
                    />
                </div>

                <div class="important-note">
                    Important Note: Quad Bike ride only Fenced Area .5 to 11 Year Old age group we recommend
                </div>

                <div class="package-container" :class="{ 'selected': options.quad_kids_single }">
                    <div style="display: flex; align-items: center;">
                        <div class="toggle-switch"
                             :class="{ 'active': options.quad_kids_single }"
                             @click="options.quad_kids_single = !options.quad_kids_single;
                                     window.dispatchEvent(new CustomEvent('package-toggle', {
                                         detail: { package: 'quad_kids_single', active: options.quad_kids_single }
                                     }));">
                            <div class="toggle-slider"></div>
                        </div>
                        <div style="display: flex; margin-left: 15px; align-items: center;">
                            <img src="https://desertbuggyrental.com/wp-content/uploads/2024/04/Desert-Quad-Bike-90-CC-Single-Seater.webp"
                                 style="width: 60px; height: 50px; object-fit: cover; margin-right: 15px; border-radius: 4px;">
                            <span class="package-title" :class="{ 'selected': options.quad_kids_single }">Kids Quad Bike Single Seater</span>
                        </div>
                    </div>
                </div>

                <div class="ride-options" x-show="options.quad_kids_single" x-transition>
                    <x-form-radio
                        name="quad_kids_single_duration"
                        label="30 Min"
                        value="30_min"
                        price="150"
                        quantityLabel="No of Quad Bikes"
                        x-on:change="calculateTotal"
                    />

                    <x-form-radio
                        name="quad_kids_single_duration"
                        label="1 Hour Ride"
                        value="1_hour"
                        price="250"
                        quantityLabel="No of Quad Bikes"
                        x-on:change="calculateTotal"
                    />

                    <x-form-radio
                        name="quad_kids_single_duration"
                        label="2 Hour Ride"
                        value="2_hour"
                        price="400"
                        quantityLabel="No of Quad Bikes"
                        x-on:change="calculateTotal"
                    />
            </div>
                </div>
            </x-form-section>

            <x-form-section title="Extra Services">
        <div x-data="{ options: { 'camel_ride': false, 'sandboarding': false, 'jet_ski': false, 'jet_car': false } }">
                <div class="package-container" :class="{ 'selected': options.camel_ride }">
                    <div style="display: flex; align-items: center;">
                        <div class="toggle-switch"
                             :class="{ 'active': options.camel_ride }"
                             @click="options.camel_ride = !options.camel_ride;
                                     window.dispatchEvent(new CustomEvent('package-toggle', {
                                         detail: { package: 'camel_ride', active: options.camel_ride }
                                     }));">
                            <div class="toggle-slider"></div>
                        </div>
                        <div style="display: flex; margin-left: 15px; align-items: center;">
                            <img src="https://desertbuggyrental.com/wp-content/uploads/2024/04/c11.webp"
                                 style="width: 60px; height: 50px; object-fit: cover; margin-right: 15px; border-radius: 4px;">
                            <span class="package-title" :class="{ 'selected': options.camel_ride }">Camel Ride in Desert 20 - 25 min</span>
                        </div>
                    </div>
                </div>

                <div class="ride-options" x-show="options.camel_ride" x-transition>
                    <x-form-radio
                        name="camel_ride_duration"
                        label="No of Persons"
                        value="no_of_persons"
                        price="150"
                    quantityLabel="Per Person"
                    x-on:change="calculateTotal"
                    />
                </div>

                <div class="package-container" :class="{ 'selected': options.sandboarding }">
                    <div style="display: flex; align-items: center;">
                        <div class="toggle-switch"
                             :class="{ 'active': options.sandboarding }"
                             @click="options.sandboarding = !options.sandboarding;
                                     window.dispatchEvent(new CustomEvent('package-toggle', {
                                         detail: { package: 'sandboarding', active: options.sandboarding }
                                     }));">
                            <div class="toggle-slider"></div>
                        </div>
                        <div style="display: flex; margin-left: 15px; align-items: center;">
                            <img src="https://desertbuggyrental.com/wp-content/uploads/2024/04/sandboarding.webp"
                                 style="width: 60px; height: 50px; object-fit: cover; margin-right: 15px; border-radius: 4px;">
                            <span class="package-title" :class="{ 'selected': options.sandboarding }">SandBoarding</span>
                        </div>
                    </div>
                </div>

                <div class="ride-options" x-show="options.sandboarding" x-transition>
                    <x-form-radio
                        name="sandboarding_duration"
                        label="No of Persons"
                        value="no_of_persons"
                        price="50"
                        quantityLabel="Per Person"
                    x-on:change="calculateTotal"
                    />
                </div>

                <div class="important-note">
                    Important Note: Jetski Single & Double Seater Price are Same, Please Write in Comment Text Box which jet ski you want to book. Our Jetski Location Near "Burj Al Arab"
                </div>

                <div class="package-container" :class="{ 'selected': options.jet_ski }">
                    <div style="display: flex; align-items: center;">
                        <div class="toggle-switch"
                             :class="{ 'active': options.jet_ski }"
                             @click="options.jet_ski = !options.jet_ski;
                                     window.dispatchEvent(new CustomEvent('package-toggle', {
                                         detail: { package: 'jet_ski', active: options.jet_ski }
                                     }));">
                            <div class="toggle-slider"></div>
                        </div>
                        <div style="display: flex; margin-left: 15px; align-items: center;">
                            <img src="https://desertbuggyrental.com/wp-content/uploads/2024/04/jetski.webp"
                                 style="width: 60px; height: 50px; object-fit: cover; margin-right: 15px; border-radius: 4px;">
                            <span class="package-title" :class="{ 'selected': options.jet_ski }">Jet Ski ( Single & Double Seater )</span>
                        </div>
                    </div>
                </div>

                <div class="ride-options" x-show="options.jet_ski" x-transition>
                    <x-form-radio
                        name="jet_ski_duration"
                        label="30 Min Jet Ski"
                        value="30_min"
                        price="350"
                    quantityLabel="No of Jet-Ski"
                    x-on:change="calculateTotal"
                    />
                    <x-form-radio
                        name="jet_ski_duration"
                        label="1 Hour Jet Ski"
                        value="1_hour"
                        price="650"
                    quantityLabel="No of Jet-Ski"
                    x-on:change="calculateTotal"
                    />
                    <x-form-radio
                        name="jet_ski_duration"
                        label="2 Hour Jet Ski"
                        value="2_hour"
                        price="850"
                    quantityLabel="No of Jet-Ski"
                    x-on:change="calculateTotal"
                    />
                </div>

                <div class="package-container" :class="{ 'selected': options.jet_car }">
                    <div style="display: flex; align-items: center;">
                        <div class="toggle-switch"
                             :class="{ 'active': options.jet_car }"
                             @click="options.jet_car = !options.jet_car;
                                     window.dispatchEvent(new CustomEvent('package-toggle', {
                                         detail: { package: 'jet_car', active: options.jet_car }
                                     }));">
                            <div class="toggle-slider"></div>
                        </div>
                        <div style="display: flex; margin-left: 15px; align-items: center;">
                            <img src="https://desertbuggyrental.com/wp-content/uploads/2024/04/2seaternewjetcardubai.webp"
                                 style="width: 60px; height: 50px; object-fit: cover; margin-right: 15px; border-radius: 4px;">
                            <span class="package-title" :class="{ 'selected': options.jet_car }">2 Seater Jet Car</span>
                        </div>
                    </div>
                </div>

                <div class="ride-options" x-show="options.jet_car" x-transition>
                    <x-form-radio
                        name="jet_car_duration"
                        label="30 Min Jet Car"
                        value="30_min"
                        price="750"
                    quantityLabel="No of Jet-Car"
                    x-on:change="calculateTotal"
                    />
                    <x-form-radio
                        name="jet_car_duration"
                        label="1 Hour Jet Car"
                        value="1_hour"
                        price="950"
                    quantityLabel="No of Jet-Car"
                    x-on:change="calculateTotal"
                    />
                    <x-form-radio
                        name="jet_car_duration"
                        label="2 Hour Jet Car"
                        value="2_hour"
                        price="1650"
                    quantityLabel="No of Jet-Car"
                    x-on:change="calculateTotal"
                    />
        </div>
                </div>
            </x-form-section>

            <x-form-section title="BBQ Dinner + Live Entertainment Shows">
    <div x-data="{ options: { 'standard_camp': false, 'premium_camp': false } }">
                <div class="important-note">
                    Important Note:
                </div>

                <div class="note-content">
                    <h4>Winter Timings</h4>
                    <ul>
                        <li>Pickup Time (October - March): 2:45 PM to 3:30 PM</li>
                        <li>Dropoff Time (October - March): 9:00 PM to 9:30 PM</li>
                    </ul>

                    <h4>Summer Timings</h4>
                    <ul>
                        <li>Pickup Time (April - September): 3:45 PM to 4:30 PM</li>
                        <li>Dropoff Time (October - March): 9:30 PM to 9:45 PM</li>
                        <li>Excursion Timings Select According to Season</li>
                        <li>Select Private Transfers 5-6 Persons are Allowed in One Car</li>
                        <li>You must select Private Transfer for BBQ Dinner + Live Entertainment Shows</li>
                    </ul>
                </div>

        <div class="package-container" :class="{ 'selected': options.standard_camp }">
            <div style="display: flex; align-items: center;">
                <div class="toggle-switch"
                     :class="{ 'active': options.standard_camp }"
                     @click="options.standard_camp = !options.standard_camp;
                             window.dispatchEvent(new CustomEvent('package-toggle', {
                                 detail: { package: 'standard_camp', active: options.standard_camp }
                             }));">
                    <div class="toggle-slider"></div>
                </div>
                <div style="display: flex; margin-left: 15px; align-items: center;">
                    <img src="https://desertbuggyrental.com/wp-content/uploads/2024/04/standardcamp.webp"
                         style="width: 60px; height: 50px; object-fit: cover; margin-right: 15px; border-radius: 4px;">
                    <span class="package-title" :class="{ 'selected': options.standard_camp }">Standard Camp ( BBQ Dinner + Live Entertainment Shows)</span>
                </div>
            </div>
        </div>

        <div class="ride-options" x-show="options.standard_camp" x-transition>
                    <x-form-radio
                        name="standard_camp_duration"
                        label="No of Persons"
                        value="no_of_persons"
                        price="125"
                quantityLabel="Price per Person"
                x-on:change="calculateTotal"
                    />
                </div>

        <div class="package-container" :class="{ 'selected': options.premium_camp }">
            <div style="display: flex; align-items: center;">
                <div class="toggle-switch"
                     :class="{ 'active': options.premium_camp }"
                     @click="options.premium_camp = !options.premium_camp;
                             window.dispatchEvent(new CustomEvent('package-toggle', {
                                 detail: { package: 'premium_camp', active: options.premium_camp }
                             }));">
                    <div class="toggle-slider"></div>
                </div>
                <div style="display: flex; margin-left: 15px; align-items: center;">
                    <img src="https://desertbuggyrental.com/wp-content/uploads/2024/04/premiumcamp.webp"
                         style="width: 60px; height: 50px; object-fit: cover; margin-right: 15px; border-radius: 4px;">
                    <span class="package-title" :class="{ 'selected': options.premium_camp }">Premium Camp ( BBQ Dinner + Live Entertainment Shows )</span>
                </div>
            </div>
        </div>

        <div class="ride-options" x-show="options.premium_camp" x-transition>
                    <x-form-radio
                        name="premium_camp_duration"
                        label="No of Persons"
                        value="no_of_persons"
                        price="250"
                quantityLabel="Price per Person"
                x-on:change="calculateTotal"
                    />
                </div>
    </div>
            </x-form-section>

            <x-form-section title="Private Pickup & Dropoff">
    <div x-data="{ options: { 'transfer': false }, showTransferFields: false }">
                <div class="important-note">
                    Important Note
                </div>

                <div class="note-content">
                    <ul>
                        <li>In Sharing Transfer Should be a Minimum of Two Person's Same Pickup location Otherwise, Choose Private Transfer</li>
                        <li>Private Transfers 5-6 Persons are Allowed in One Car</li>
                        <li>Pickup Time Will be 1 Hour Before Starting Your Excursion Time.</li>
                        <li>If You Don't Want Pickup & Dropoff Option, You will Get Automatically Our Meeting-Point Location at your Registered Email Address, When you Complete your Order.</li>
                    </ul>
                </div>

        <div class="package-container" :class="{ 'selected': options.transfer }">
            <div style="display: flex; align-items: center;">
                <div class="toggle-switch"
                     :class="{ 'active': options.transfer }"
                     @click="options.transfer = !options.transfer;
                             window.dispatchEvent(new CustomEvent('package-toggle', {
                                 detail: { package: 'transfer', active: options.transfer }
                             }));">
                    <div class="toggle-slider"></div>
                </div>
                <div style="display: flex; margin-left: 15px; align-items: center;">
                    <img src="https://desertbuggyrental.com/wp-content/uploads/2024/04/pickupdropoff.webp"
                         style="width: 60px; height: 50px; object-fit: cover; margin-right: 15px; border-radius: 4px;">
                    <span class="package-title" :class="{ 'selected': options.transfer }">Pickup & Dropoff (Private & Sharing)</span>
                </div>
            </div>
        </div>

        <div class="ride-options" x-show="options.transfer" x-transition>
                    <x-form-radio
                        name="transfer_option"
                label="No (Select this option If you don't want transfer)"
                        value="no_transfer"
                x-on:change="showTransferFields = false; calculateTotal()"
                    />

                    <x-form-radio
                        name="transfer_option"
                        label="Private Transfer (No. of Car's)"
                        value="private_transfer"
                        price="450"
                x-on:change="showTransferFields = true; calculateTotal()"
                    />

                    <x-form-radio
                        name="transfer_option"
                        label="Sharing Transfer (No. of Persons)"
                        value="sharing_transfer"
                        price="175"
                x-on:change="showTransferFields = true; calculateTotal()"
            />

            <div class="transfer-fields" x-show="showTransferFields" x-transition>
                <div class="form-group mt-3">
                    <label for="pickup_location" class="required-field">Pickup location/ Hotel Name</label>
                    <input
                        type="text"
                        name="pickup_location"
                        id="pickup_location"
                        class="form-control"
                        :required="showTransferFields && (selectedOptions.transfer_option === 'private_transfer' || selectedOptions.transfer_option === 'sharing_transfer')"
                    >

                    <label for="hotel_room" class="mt-2">Hotel Room No</label>
                    <input type="text" name="hotel_room" id="hotel_room" class="form-control">
                </div>
            </div>
        </div>
                </div>
            </x-form-section>
        </div>

        <div class="comments-section">
            <h3>Comments</h3>
    <textarea name="comments" class="comments-area" placeholder="Add your comments here" x-on:input="handleCommentInput"></textarea>
    <div class="char-count" x-text="remainingChars + ' characters remaining'"></div>
        </div>

        <div class="final-total">
            <div class="label">Final Total</div>
    <div class="amount" x-text="'AED ' + total"></div>
        </div>

    </x-form>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('formCalculations', () => ({
            total: 0,
            remainingChars: 500,
            selectedPackages: {},
            selectedOptions: {},
            quantities: {},
            packageStates: {},

            init() {
                // Initialize with empty options - nothing selected by default
                this.selectedPackages = {};
                this.selectedOptions = {};
                this.quantities = {};
                this.packageStates = {};

                // Ensure 0 as default total
                this.total = 0;

                // Calculate initial total (should be 0)
                this.calculateTotal();

                // Listen for radio option selection
                document.addEventListener('DOMContentLoaded', () => {
                    // Check all initially checked radio buttons
                    document.querySelectorAll('input[type="radio"]:checked').forEach(radio => {
                        if (radio.hasAttribute('data-price')) {
                            const name = radio.getAttribute('name');
                            const value = radio.getAttribute('value');
                            this.selectedOptions[name] = value;
                            this.quantities[`${name}_${value}`] = 1;
                        }
                    });
                    this.calculateTotal();
                });

                // Listen for package selections
                this.$el.addEventListener('package-selected', (event) => {
                    const { name, value } = event.detail;
                    this.selectedPackages[name] = value;
                    this.calculateTotal();
                });

                // Listen for option selections
                this.$el.addEventListener('option-selected', (event) => {
                    const { name, value, quantity } = event.detail;
                    this.selectedOptions[name] = value;
                    this.quantities[`${name}_${value}`] = quantity || 1;
                    this.calculateTotal();
                });

                // Listen for option removals
                this.$el.addEventListener('option-removed', (event) => {
                    const { name, value } = event.detail;
                    if (this.selectedOptions[name] === value) {
                        delete this.selectedOptions[name];
                        delete this.quantities[`${name}_${value}`];
                    }
                    this.calculateTotal();
                });

                // Listen for quantity changes
                this.$el.addEventListener('quantity-changed', (event) => {
                    const { option, value, quantity } = event.detail;
                    if (option) {
                        // For radio option quantities
                        this.quantities[`${option}_${value}`] = quantity;
                    } else {
                        // For package quantities
                        this.quantities[value] = quantity;
                    }
                    this.calculateTotal();
                });

                // Listen for package toggle state changes
                window.addEventListener('package-toggle', (event) => {
                    const { package: packageName, active } = event.detail;
                    this.packageStates[packageName] = active;
                    this.calculateTotal();
                });
            },

            handleCommentInput(e) {
    const maxChars = 500;
                const currentLength = e.target.value.length;
                this.remainingChars = maxChars - currentLength;

                if (currentLength > maxChars) {
                    e.target.value = e.target.value.substring(0, maxChars);
                    this.remainingChars = 0;
                }
            },

            calculateTotal() {
                this.total = 0;

                // Process each selected option
                for (const [optionName, optionValue] of Object.entries(this.selectedOptions)) {
                    const radioElement = document.querySelector(`input[name="${optionName}"][value="${optionValue}"]`);

                    if (radioElement && radioElement.hasAttribute('data-price')) {
                        // Check if the parent package is active
                        const packageName = this.getPackageNameFromOptionName(optionName);
                        if (packageName && this.packageStates[packageName] === false) {
                            // Skip this option if its package is toggled off
                            continue;
                        }

                        const price = parseFloat(radioElement.getAttribute('data-price'));
                        const quantity = this.quantities[`${optionName}_${optionValue}`] || 1;
                        this.total += price * quantity;
                    }
                }
            },

            // Helper to determine which package an option belongs to
            getPackageNameFromOptionName(optionName) {
                // Map option name patterns to their specific package names
                if (optionName.startsWith('dirt_bike_')) {
                    return 'ktm_dirt_bike';
                } else if (optionName.startsWith('buggy_2_seater_duration')) {
                    return 'buggy_2_seater';
                } else if (optionName.startsWith('buggy_2_seater_turbo_duration')) {
                    return 'buggy_2_seater_turbo';
                } else if (optionName.startsWith('buggy_4_seater_duration')) {
                    return 'buggy_4_seater';
                } else if (optionName.startsWith('buggy_4_seater_turbo_duration')) {
                    return 'buggy_4_seater_turbo';
                } else if (optionName.startsWith('canam_2_seater_duration')) {
                    return 'canam_2_seater';
                } else if (optionName.startsWith('canam_2_seater_turbo_duration')) {
                    return 'canam_2_seater_turbo';
                } else if (optionName.startsWith('canam_4_seater_duration')) {
                    return 'canam_4_seater';
                } else if (optionName.startsWith('canam_4_seater_turbo_duration')) {
                    return 'canam_4_seater_turbo';
                } else if (optionName.startsWith('quad_')) {
                    return 'quad_' + optionName.split('_')[1] + '_' + optionName.split('_')[2];
                } else if (optionName.startsWith('camel_ride_')) {
                    return 'camel_ride';
                } else if (optionName.startsWith('sandboarding_')) {
                    return 'sandboarding';
                } else if (optionName.startsWith('jet_ski_')) {
                    return 'jet_ski';
                } else if (optionName.startsWith('jet_car_')) {
                    return 'jet_car';
                } else if (optionName.startsWith('standard_camp_')) {
                    return 'standard_camp';
                } else if (optionName.startsWith('premium_camp_')) {
                    return 'premium_camp';
                } else if (optionName.startsWith('transfer_')) {
                    return 'transfer';
                }
                return null;
            }
        }));
    });
</script>
</body>
</html>
