<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Posts</title>
</head>
<body>
    <h1>Data Posts</h1>
    <table cellpadding="5" border="1">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Nama User</th>
                    <th>Nama Kategori</th>
                </tr>
            </thead>
            <tbody>
                @php $no= 1; @endphp
                @foreach($comments as $row)
                <tr>
                    <th scope="row">{{ $no++ }}</th>
                    <td>{{ $row->content }}</td>
                    <td>{{ $row->post->title }}</td>
                    <td>{{ $row->user->name }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>