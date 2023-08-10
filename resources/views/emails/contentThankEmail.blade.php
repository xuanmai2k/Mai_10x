<div style="max-width: 500px; margin: 0 auto; padding: 20px; font-family: Arial, sans-serif; background-color: #f9f9f9; border: 1px solid #ccc; border-radius: 5px;">
    <h2 style="text-align: center; font-weight: bold; color: #333; margin-bottom: 20px;">Dear {{ $appointment->name }},</h2>
    <p style="color: #555; line-height: 1.5em;">Thank you for choosing our vaccination service. We hope that you are feeling well and that the {{ $appointment->category->name }} vaccines you received have been effective in keeping you and your loved ones safe and healthy.</p>
    <h3 style="font-weight: bold; color: #333; margin-top: 30px; margin-bottom: 20px;">Order Details:</h3>
    <ul style="list-style: none; padding-left: 0;">
        <li style="color: #555; margin-bottom: 5px;"><span style="font-weight: bold;">Order ID:</span> {{ $appointment->order_id }}</li>
        <li style="color: #555; margin-bottom: 5px;"><span style="font-weight: bold;">Name:</span> {{ $appointment->name }}</li>
        <li style="color: #555; margin-bottom: 5px;"><span style="font-weight: bold;">Phone:</span> {{ $appointment->phone }}</li>
        <li style="color: #555; margin-bottom: 5px;"><span style="font-weight: bold;">Age:</span> {{ $appointment->age }}</li>
        <li style="color: #555; margin-bottom: 5px;"><span style="font-weight: bold;">Date:</span> {{ $appointment->date_appointment }} <span style="font-weight: bold;">Time:</span>{{ substr($appointment->time_appointment, 0, 5) }}</li>
        <li style="color: #555; margin-bottom: 5px;"><span style="font-weight: bold;">Doctor:</span> {{ $appointment->doctor->name }}</li>
        <li style="color: #555; margin-bottom: 5px;"><span style="font-weight: bold;">Nurse:</span> {{ $appointment->nurse->name}}</li>
        <li style="color: #555; margin-bottom: 5px;"><span style="font-weight: bold;">Product:</span> {{ $appointment->product->name_product }}</li>
        <li style="color: #555; margin-bottom: 5px;"><span style="font-weight: bold;">Price:</span> {{ $appointment->total_price }}$</li>
        <li style="color: #555; margin-bottom: 5px;"><span style="font-weight: bold;">Payment:</span> {{ $appointment->status_payment }}</li>
    </ul>
    <p style="color: #555; line-height: 1.5em;">If you have any questions or concerns about your vaccination or need to schedule an appointment for a second dose, please don't hesitate to contact us. We are happy to help in any way we can.</p>
    <p style="color: #555; line-height: 1.5em;">Once again, thank you for choosing MaiVaccine for your vaccination needs. We appreciate your business and hope to have the opportunity to serve you again in the future.</p>
    <p style="font-weight: bold; color: #333; margin-top: 30px;">Sincerely,</p>
    <p style="font-weight: bold; color: #333;">MaiVaccine</p>
</div>
