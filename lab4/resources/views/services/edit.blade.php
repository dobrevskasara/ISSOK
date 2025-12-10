<h1>Edit Reservation</h1>

<form action="{{ route('services.update', $service->id) }}" method="POST">
    @csrf
    @method('PUT')


    <label for="mechanic_fullname">Mechanic FullName:</label><br>
    <input type="text" id="mechanic_fullname" name="mechanic_fullname" value="{{ $service->mechanic_fullname }}" required><br><br>

    <label for="client_fullname">Client FullName:</label><br>
    <input type="text" id="client_fullname" name="client_fullname" value="{{ $service->client_fullname }}" required><br>

    <label for="vehicle_brand">Vehicle Brand</label><br>
    <input type="text" id="vehicle_brand" name="vehicle_brand" value="{{ $service->vehicle_brand }}" required><br><br>

    <label for="vehicle_type">Vehicle Type:</label><br>
    <input type="text" id="vehicle_type" name="vehicle_type" value="{{ $service->vehicle_type }}" required><br><br>

    <label for="plate">Plate:</label><br>
    <input type="text" id="plate" name="plate" value="{{ $service->plate }}" required><br><br>

    <label for="description">Description:</label><br>
    <input type="text" id="description" name="description" value="{{ $service->description }}" required><br><br>

    <label for="price">Price:</label><br>
    <input type="number" id="price" name="price" min="1" value="{{ $service->price }}" required><br><br>

    <label for="check_in_date">Check-In Date:</label><br>
    <input type="date" id="check_in_date" name="check_in_date" value="{{ $service->check_in_date }}" required><br><br>

    <label for="check_out_date">Check-Out Date:</label><br>
    <input type="date" id="check_out_date" name="check_out_date" value="{{ $service->check_out_date }}" required><br><br>



    <button type="submit">Update Service</button>
</form>
