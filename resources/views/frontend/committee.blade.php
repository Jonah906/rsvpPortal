@extends('frontend.layouts.app')

@section('content')
    <section class="services-section spad">

        <h2 style="text-align: center; text-decoration: underline; margin-bottom: 20px;">CONTACT PERSONS</h2>

        <div style="display: flex; justify-content: center;">
            <table style="width: 80%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr>
                        <th style="border: 1px solid #000; padding: 10px;">S/N</th>
                        <th style="border: 1px solid #000; padding: 10px;">Names Of Members</th>
                        <th style="border: 1px solid #000; padding: 10px;">Email</th>
                        <th style="border: 1px solid #000; padding: 10px;">Phone Number</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $contacts = [
                        ["id" => 1, "name" => "David Edoziem", "email" => "david.edoziem@henryoakpata.com", "phone" => ["0705 082 1545"]],
                        ["id" => 2, "name" => "Jennifer Etsu","email" => "jennifer.etsu@henryoakpata.com", "phone" => ["08166492677"]],
                        ["id" => 3, "name" => "Ameze Akpata", "phone" => ["07056631590"]],
                        ["id" => 4, "name" => "Uju Nwanna","email" => "uju.nwanna@henryoakpata.com", "phone" => ["07036288841"]],
                    ];
                    ?>

                    <?php foreach ($contacts as $contact) : ?>
                        <tr>
                            <td style="border: 1px solid #000; padding: 10px;"><?php echo $contact['id'] ?></td>
                            <td style="border: 1px solid #000; padding: 10px;"><?php echo $contact['name'] ?></td>
                            <td style="border: 1px solid #000; padding: 10px;"><?php echo isset($contact['email']) ? $contact['email'] : '-'; ?></td>
                            <td style="border: 1px solid #000; padding: 10px;"><?php echo !empty($contact['phone']) ? implode(", ", $contact['phone']) : '-'; ?></td>
                        </tr>

                    <?php endforeach; ?>


                </tbody>
            </table>
        </div>
    </section>
@endsection
