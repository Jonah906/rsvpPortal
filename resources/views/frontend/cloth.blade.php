@extends('frontend.layouts.app')

@section('content')
    <!-- Contact Section Begin -->
    <section class="services-section spad">

        <h2 style="text-align: center; text-decoration: underline; margin-bottom: 20px;">ASO-EBI INFORMATION</h2>

        <div style="max-width: 800px; margin: 0 auto; padding: 0 20px; font-size: 16px; line-height: 1.8;">
            <p><strong>To purchase Aso Ebi</strong> for <strong>Dr. Henry Omorogieva Akpata's funeral</strong> taking place on <strong>May 16th, 2025</strong> in <strong>Benin City</strong>, kindly follow the details below:</p>

            <p><strong>Payment Amount:</strong> Thirteen Thousand Five-Hundred Naira (₦13,500)</p>

            <p><strong>Bank Details:</strong><br>
                <strong>Account Number:</strong> 5400602412<br>
                <strong>Account Name:</strong> Samagio Consulting<br>
                <strong>Bank Name:</strong> Providus Bank
            </p>

            <p><strong>Collection Instructions:</strong><br>
                Please share your <strong>proof of payment</strong> with any of the designated contacts listed below according to your location.
            </p>
        </div>


        <?php
        $contacts = [
            "LAGOS" => [
                ["contact" => "OSA", "phone" => "08053256859"],
                ["contact" => "NOSA", "phone" => "08058114236"]
            ],
            "BENIN" => [
                ["contact" => "AMEZE", "phone" => "07056631590"],
                ["contact" => "JENNIFER", "phone" => "08176139312"]
            ],
            "ABUJA" => [
                ["contact" => "UJU", "phone" => "07036288841"],
                ["contact" => "TAOFIKA", "phone" => "08060972945"]
            ],
            "WARRI" => [
                ["contact" => "EFE", "phone" => "08030855617"]
            ],
        ];

        $max_rows = max(array_map('count', $contacts));
        ?>


        <div style="display: flex; justify-content: center;">
            <table style="width: 90%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr>
                        <th style="border: 1px solid #000; padding: 10px;">LAGOS</th>
                        <th style="border: 1px solid #000; padding: 10px;">BENIN</th>
                        <th style="border: 1px solid #000; padding: 10px;">ABUJA</th>
                        <th style="border: 1px solid #000; padding: 10px;">WARRI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i = 0; $i < $max_rows; $i++) : ?>
                        <tr>
                            <?php foreach (["LAGOS", "BENIN", "ABUJA", "WARRI"] as $state) : ?>
                                <td style="border: 1px solid #000; padding: 10px;">
                                    <?php if (isset($contacts[$state][$i])) : ?>
                                        <strong><?= $contacts[$state][$i]['contact'] ?></strong><br>
                                        <?= $contacts[$state][$i]['phone'] ?>
                                    <?php else : ?>
                                        &nbsp;
                                    <?php endif; ?>
                                </td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endfor; ?>
                </tbody>
            </table>
        </div>

    </section>
@endsection