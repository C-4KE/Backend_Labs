<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <title>Customer</title>
</head>
<body>
    <div class="container mt-5">
        <div>
            <p>ID: {{ $customer->id }}</p>
            <p>Is banned: {{ $customer->is_banned }}</p>
            <p>Name: {{ $customer->name }}</p>
            <p>Surname: {{ $customer->surname }}</p>
            <p>Phone: {{ $customer->phone }}</p>
            <p>Email: {{ $customer->email }}</p>
            <p>Created at: {{ $customer->created_at }}</p>
            <p>Updated at: {{ $customer->updated_at }}</p>
        </div>
        <table class="table table-bordered mb-5">
            <thead>
                <tr class="table-success">
                    <th scope="col">ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">City</th>
                    <th scope="col">Street</th>
                    <th scope="col">House</th>
                    <th scope="col">Floor</th>
                    <th scope="col">Apartment</th>
                    <th scope="col">Intercom code</th>
                    <th scope="col">Created at</th>
                    <th scope="col">Updated at</th>
                </tr>
            </thead>
            <tbody>
                @foreach($addresses as $address)
                <tr>
                    <th scope="row">{{ $address->id }}</th>
                    <td>{{ $address->title }}</td>
                    <td>{{ $address->city }}</td>
                    <td>{{ $address->street }}</td>
                    <td>{{ $address->house }}</td>
                    <td>{{ $address->floor }}</td>
                    <td>{{ $address->apartment }}</td>
                    <td>{{ $address->intercom_code }}</td>
                    <td>{{ $customer->created_at }}</td>
                    <td>{{ $customer->updated_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>