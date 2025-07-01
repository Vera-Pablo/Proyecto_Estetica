<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ticket de Compra</title>
    <style>
        /* --- General Setup --- */
        @page {
            margin: 0; /* Quita los márgenes por defecto del PDF */
        }
        body { 
            font-family: 'Helvetica', 'Arial', sans-serif; /* Usamos fuentes comunes para PDF */
            color: #333;
            font-size: 10pt;
            margin: 2cm; /* Creamos nuestros propios márgenes */
        }

        /* --- Header Section --- */
        .header {
            padding-bottom: 20px;
            overflow: auto; /* Para que los floats funcionen */
        }
        .header-logo {
            float: left;
            width: 40%;
            text-align: left;
        }
        .header-logo .logo-box {
            background-color: #FADBD8; /* Color rosa pálido del ejemplo */
            display: inline-block;
            padding: 20px;
            color: #333;
            font-size: 1.5rem;
            font-weight: bold;
        }
        .header-invoice {
            float: right;
            width: 40%;
            text-align: right;
        }
        .header-invoice h2 {
            margin: 0;
            font-size: 2rem;
            color: #333;
        }
        .header-invoice span {
            font-size: 1rem;
            color: #666;
        }

        /* --- Contact Info Section --- */
        .contact-section {
            background-color: #FEF9E7; /* Un color crema muy suave */
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 30px;
            overflow: auto;
        }
        .contact-title {
            background-color: #FADBD8; /* Rosa pálido */
            color: #333;
            padding: 5px 10px;
            display: inline-block;
            font-weight: bold;
            margin-bottom: 10px;
            font-size: 0.9rem;
            text-transform: uppercase;
        }
        .contact-info {
            width: 100%;
            line-height: 1.6;
        }
        .contact-info td {
            padding-bottom: 5px;
        }
        .contact-info .label {
            font-weight: bold;
        }
        
        /* --- Table for Products --- */
        .products-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .products-table thead th {
            background-color: #FADBD8; /* Rosa pálido */
            color: #333;
            padding: 12px;
            text-align: left;
            border: none;
            font-weight: bold;
            text-transform: uppercase;
        }
        .products-table tbody td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }
        .products-table tbody tr:last-child td {
            border-bottom: 2px solid #333;
        }

        /* --- Total Section --- */
        .total-section {
            margin-top: 20px;
            overflow: auto; /* Para que los floats funcionen */
        }
        .total-box {
            float: right;
            width: 40%;
        }
        .total-table {
            width: 100%;
        }
        .total-table td {
            padding: 8px;
        }
        .total-table .total-label {
            background-color: #FADBD8; /* Rosa pálido */
            font-weight: bold;
            text-align: center;
        }
        .total-table .total-amount {
            font-weight: bold;
            font-size: 1.2rem;
            border-bottom: 2px solid #333;
            text-align: right;
        }

        /* --- Footer --- */
        .footer {
            position: fixed;
            bottom: 1cm;
            left: 2cm;
            right: 2cm;
            text-align: center;
            font-size: 9pt;
            color: #888;
        }
    </style>
</head>
<body>

    <table width="100%" style="margin-bottom: 20px;">
        <tr>
            <td style="width: 50%; vertical-align: top;">
                <img src="<?= base_url('assets/img/VB.png') ?>" style="max-height: 70px;" alt="Logo">
            </td>
            <td style="width: 50%; text-align: right; vertical-align: top;">
                <div style="font-size: 2rem; font-weight: bold; letter-spacing: 2px;">FACTURA</div>
                <div style="font-size: 1.1rem; margin-top: 5px;">
                    N° <?= str_pad($venta['id'], 5, '0', STR_PAD_LEFT) ?>
                </div>
                <div style="font-size: 0.95rem; margin-top: 5px;">
                    N° de Compra: <?= $venta['id'] ?>
                </div>
            </td>
        </tr>
    </table>

    <div class="contact-section">
        <div class="contact-title">INFORMACIÓN DE CONTACTO</div>
        <table class="contact-info">
            <tr>
                <td class="label" width="30%">Nombre y Apellido:</td>
                <td width="70%"><?= esc($usuario['nombre'] ?? '') ?> <?= esc($usuario['apellido'] ?? '') ?></td>
            </tr>
             <tr>
                <td class="label">Fecha:</td>
                <td><?= date('d/m/Y H:i', strtotime($venta['fecha'])) ?></td>
            </tr>
            <!-- Puedes agregar más filas si tienes más datos (dirección, teléfono, etc.) -->
        </table>
    </div>

    <table class="products-table">
        <thead>
            <tr>
                <th style="width: 50%;">DESCRIPCIÓN</th>
                <th style="width: 20%; text-align: center;">CANTIDAD</th>
                <th style="width: 30%; text-align: right;">PRECIO</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($detalles as $detalle): ?>
                <tr>
                    <td><?= esc($detalle['producto_nombre']) ?></td>
                    <td style="text-align: center;"><?= esc($detalle['cantidad']) ?></td>
                    <td style="text-align: right;">$<?= number_format($detalle['precio'] * $detalle['cantidad'], 2, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>
             <!-- Añadir filas vacías si hay pocos productos para mantener el estilo -->
            <?php for ($i = count($detalles); $i < 5; $i++): ?>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            <?php endfor; ?>
        </tbody>
    </table>

    <div class="total-section">
        <div class="total-box">
             <table class="total-table">
                <tr>
                    <td class="total-label">TOTAL</td>
                    <td class="total-amount">$<?= number_format($venta['total'], 2, ',', '.') ?></td>
                </tr>
            </table>
        </div>
    </div>
    
    

</body>
</html>
