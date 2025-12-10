<h1>Create Reservation</h1>

<form action="{{ route('services.store') }}" method="POST">
    @csrf

    <label for="mechanic_fullname">Mechanic FullName:</label><br>
    <input type="text" id="mechanic_fullname" name="mechanic_fullname" required><br><br>

    <label for="client_fullname">Client FullName:</label><br>
    <input type="text" id="client_fullname" name="client_fullname" required><br>

    <label for="vehicle_brand">Vehicle Brand</label><br>
    <input type="text" id="vehicle_brand" name="vehicle_brand" required><br><br>

    <label for="vehicle_type">Vehicle Type:</label><br>
    <input type="text" id="vehicle_type" name="vehicle_type" required><br><br>

    <label for="plate">Plate:</label><br>
    <input type="text" id="plate" name="plate" required><br><br>

    <label for="description">Description:</label><br>
    <input type="text" id="description" name="description" required><br><br>

    <label for="price">Price:</label><br>
    <input type="number" id="price" name="price" min="1" required><br><br>

    <label for="check_in_date">Check-In Date:</label><br>
    <input type="date" id="check_in_date" name="check_in_date" required><br><br>

    <label for="check_out_date">Check-Out Date:</label><br>
    <input type="date" id="check_out_date" name="check_out_date" required><br><br>

    <button type="submit">Create Service</button>
</form>
