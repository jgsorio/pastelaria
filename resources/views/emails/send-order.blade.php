<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        .container {
            width: 100%;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .title {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ccc;
            background-color: #bbb;
        }
        
        .info {
          display:flex;
          flex-direction: column;
          align-items: center;
        }
        
        .info p {
          text-align: center
        }
        
        table {
          width: 100%;
          text-align: center;
          border-spacing: 0;
        }
        
        table tbody tr td {
          border-top: 1px solid #ccc !important;
          margin: 0;
          padding: 10px;
        }
        
        table thead tr th {
          padding: 10px;
        }
        
        table tfoot tr {
          background-color: #bbb;
        }
        
        table tfoot tr td {
          padding: 10px;
          font-weight: bold;
        }
        
    </style>
</head>
<body>
    <div class="container">
        <h1 class="title">Laravel Pastelaria</h1>
        <div class="info">
          <h2>Olá {{ $info['client']->name }}</h2>
          <p>Seu pedido foi efetuado com sucesso, agradeçemos pela sua compra!</p>
          <p>Segue abaixo os dados do seu pedido.</p>
        </div>
        <div class="order">
          <table>
            <thead>
              <tr>
                <th>Pedido</th>
                <th>Preço</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($info['products'] as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>R$ {{ substr($product->price, 0, -2) . ',' . substr($product->price, -2) }}</td>
                </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <td>Total</td>
                <td>R$ {{ substr($info['total'], 0, -2) . ',' . substr($info['total'], -2) }}</td>
              </tr>
            </tfoot>
          </table>
        </div>
    </div>
</body>
</html>