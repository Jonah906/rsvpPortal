@extends('frontend.layouts.app')

@section('content')
   <!-- Contact Section Begin -->
    <section class="services-section spad">

        <h2 style="text-align: center; text-decoration: underline; margin-bottom: 20px;">VEHICLE SERVICE CONTACT</h2>

        <div style="display: flex; justify-content: center;">
            <table style="width: 80%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr>
                        <th style="border: 1px solid #000; padding: 10px;">S/N</th>
                        <th style="border: 1px solid #000; padding: 10px;">Contact Person</th>
                        <th style="border: 1px solid #000; padding: 10px;">Phone Number</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $contacts = [
                        ["id" => 1,  "contact"=>"Tenten",  "phone" => ["08038027266"]],
                        ["id" => 2,  "contact"=>"Mr Joshua",  "phone" => ["08033888619"]],
                    ];
                    ?>

                    <?php foreach ($contacts as $contact) : ?>
                        <tr>
                            <td style="border: 1px solid #000; padding: 10px;"><?php echo $contact['id'] ?></td>
                            <td style="border: 1px solid #000; padding: 10px;"><?php echo $contact['contact'] ?></td>
                            <td style="border: 1px solid #000; padding: 10px;"><?php echo !empty($contact['phone']) ? implode(", ", $contact['phone']) : '-'; ?></td>
                        </tr>

                    <?php endforeach; ?>


                </tbody>
            </table>
        </div>
    </section>
    <!-- Contact Section End -->
@endsection
@section('scripts')
    
@endsection