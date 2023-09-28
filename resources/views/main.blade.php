<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Тестовое задание</title>
    <style>
        body: {
            margin: 0;
            padding: 0;
        }


        table tr {
            margin: 20px;
        }

        table td,
        th {
            padding: 10px 10px 10px 0;
            text-align: left;
            border-right: 1px dotted grey;

        }

        table th {
            border-bottom: 1px dotted grey;
        }
    </style>
</head>

<body>

    <div style="margin: 0 auto; width: 900px;">
        <h2>Заполните форму</h2>
        @if ($errors->any())
            Ошибка:<br />
            @foreach ($errors->all() as $e)
                <span style="color: red;"> {{ $e }}</span> <br />
            @endforeach
            <br />
        @endif
        <!-- Nothing worth having comes easy. - Theodore Roosevelt -->
        <form action="/storeEvent" method="post">
            @csrf

            <label for="title">Title:</label><br />
            <input type="text" id="title" name="title">

            <br />
            <br />

            <label for="place">Place:</label><br />
            <input type="text" id="place" name="place">

            <br />
            <br />

            <label for="date">Date (dd.mm.YY):</label><br />
            <input type="text" id="date" name="date">

            <br />
            <br />

            <input type="submit">
        </form>

        <br /><br />

        @if (count($events) > 0)
            <h2>Список событий</h2>
            <table>
                <tr>
                    <th>Name</th>

                    <th>Date</th>
                    <th>Period</th>

                </tr>
                @foreach ($events as $e)
                    <tr>
                        <td>{{ $e->name }}</td>

                        <td>{{ $e->date }}</td>
                        <td>{{ $e->period }}</td>
                    </tr>
                @endforeach

            </table>

        @endif
    </div>



</body>

</html>
