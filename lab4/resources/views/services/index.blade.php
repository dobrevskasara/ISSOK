<div>
    <h1>Services</h1>
    <a href="{{ route('services.create') }}">Add Service</a>

    @if($services->isEmpty())
        <p>No services found.</p>
    @else
        <table border="1">
            <thead>
            <tr>
                <th>Mechanic FullName</th>
                <th>Client FullName</th>
                <th>Vehicle brand</th>
                <th>Vehicle type</th>
                <th>Plate</th>
                <th>Description</th>
                <th>Price</th>
                <th>Check-In Date</th>
                <th>Check-Out Date</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($services as $service)
                <tr>
                    <td>{{ $service->mechanic_fullname}}</td>
                    <td>{{ $service->client_fullname}}</td>
                    <td>{{ $service->vehicle_brand}}</td>
                    <td>{{ $service->vehicle_type}}</td>
                    <td>{{ $service->plate}}</td>
                    <td>{{ $service->description}}</td>
                    <td>{{ $service->price}}</td>
                    <td>{{ $service->check_in_date }}</td>
                    <td>{{ $service->check_out_date }}</td>
                    <td>
                        <a href="{{ route('services.edit', $service->id) }}">Update</a>
                        <form action="{{ route('services.destroy', $service->id) }}" method="POST"
                              style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    onclick="return confirm('Are you sure you want to delete this service?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <p>Total services: {{ $sum }}</p>
        <p>Total price: {{ $total }}</p>
    @endif
</div>
