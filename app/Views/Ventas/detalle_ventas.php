<div class="container mt-5 mb-5">
    <div class="card shadow-sm">
        <div class="card-header">
            <h3>Detalle de la Compra #<?= esc($venta['id']) ?></h3>
        </div>
        <div class="card-body">
            <p><strong>Fecha de Compra:</strong> <?= date('d/m/Y H:i', strtotime(esc($venta['fecha']))) ?></p>
            <hr>
            <h4 class="mb-3">Productos Comprados</h4>
            
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Producto</th>
                            <th scope="col" class="text-center">Cantidad</th>
                            <th scope="col" class="text-end">Precio Unitario</th>
                            <th scope="col" class="text-end">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($detalles)): ?>
                            <?php foreach ($detalles as $detalle): ?>
                                <tr>
                                    <td><?= esc($detalle['producto_nombre'] ?? 'Producto no disponible') ?></td>
                                    <td class="text-center"><?= esc($detalle['cantidad']) ?></td>
                                    <td class="text-end">$<?= number_format(esc($detalle['precio_unitario']), 2, ',', '.') ?></td>
                                    <td class="text-end fw-bold">$<?= number_format($detalle['cantidad'] * $detalle['precio_unitario'], 2, ',', '.') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center">No se encontraron productos para esta venta.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-end fs-5"><strong>Total General:</strong></td>
                            <td class="text-end fs-5 fw-bolder">$<?= number_format(esc($venta['total']), 2, ',', '.') ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="text-center mt-4">
                <a href="<?= base_url('ventas') ?>" class="btn btn-secondary">Volver al Historial</a>
            </div>
        </div>
    </div>
</div>