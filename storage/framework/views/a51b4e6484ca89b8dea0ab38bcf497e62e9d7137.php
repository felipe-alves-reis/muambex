<?php $__env->startSection('title', 'Listagem de Muambas'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="panel-body">
                    <div class="box-header">
                        <h3 class="box-title">Listagem de Muambas</h3>

                        <div class="box-tools">
                            <?php echo e(link_to_route('muambas.create', 'Cadastrar', null, ['class' => 'btn btn-primary'])); ?>

                        </div>
                    </div>
                    <hr>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="filtros">
                            <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" href="#filtrosCollapse" aria-expanded="true" aria-controls="filtrosCollapse" style="display: block;">
                                    <i class="fa fa-filter" aria-hidden="true"></i> FILTROS
                                </a>
                            </h4>
                        </div>
                        <div id="filtrosCollapse" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="filtros">
                            <div class="panel-body">
                                <form id="form-busca" action="<?php echo e(route('muambas.index')); ?>" method="POST">
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <?php echo e(Form::label('Nome:', null, ['class' => 'control-label'])); ?>

                                            <?php echo e(Form::text('nome', (isset($request->nome) && !empty($request->nome) ? $request->nome : ''), ['class' => 'form-control', 'id' => 'nome'])); ?>

                                        </div>

                                        <div class="form-group col-md-3">
                                            <?php echo e(Form::label('Código Rastreio:', null, ['class' => 'control-label'])); ?>

                                            <?php echo e(Form::text('codigo_rastreio', (isset($request->codigo_rastreio) && !empty($request->codigo_rastreio) ? $request->codigo_rastreio : ''), ['class' => 'form-control', 'id' => 'codigo_rastreio'])); ?>

                                        </div>
                                    </div>
                                    <div class="btn-group">
                                        <?php echo e(Form::token()); ?>

                                        <?php echo e(Form::submit('Buscar', ['class' => 'btn btn-default', 'id' => 'btnBuscar'])); ?>

                                    </div>
                                </form>
                                <br />
                                <br />
                            </div>
                        </div>
                    </div>

                    <div class="box-body table-responsive no-padding">
                        <table class="table table-striped">
                            <thead>
                                <th>Nome</th>
                                <th>Cód Rastreio</th>
                                <th style="width: 16%">Opções</th>
                            </thead>
                            <?php if(isset($muambas) && count($muambas) > 0): ?>
                                <tbody>
                                    <?php $__currentLoopData = $muambas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $muamba): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($muamba->nome); ?></td>
                                            <td><?php echo e($muamba->codigo_rastreio); ?></td>
                                            <td>

                                                <?php if(!$muamba->fl_recebido): ?>
                                                    <?php echo e(link_to_route('muambas.edit', '', [$muamba->id], ['class' => 'btn btn-sm btn-warning glyphicon glyphicon-edit', 'title' => 'Alterar', 'data-toggle' => 'tooltip', 'data-placement' => 'top'])); ?>

                                                    <button class="btn btn-sm btn-info rastrear-muamba" style="margin-top: 3px;" data-toggle="tooltip" title="Rastrear Muamba" data-tipo="rastrear" data-nome="<?php echo e($muamba->nome); ?>" data-id="<?php echo e($muamba->id); ?>" data-codigo-rastreio="<?php echo e($muamba->codigo_rastreio); ?>" data-token="<?php echo e(csrf_token()); ?>"><i class="glyphicon glyphicon-refresh"></i></button>
                                                    <button class="btn btn-sm btn-success confirmar-recebimento" style="margin-top: 3px;" data-toggle="tooltip" title="Confirmar Recebimento" data-placemen="top" data-id="<?php echo e($muamba->id); ?>" data-token="<?php echo e(csrf_token()); ?>"><i class="glyphicon glyphicon-thumbs-up"></i></button>
                                                <?php else: ?>
                                                    <button class="btn btn-sm btn-info historico-muamba" style="margin-top: 3px;" data-toggle="tooltip" title="Histórico Muamba" data-tipo="historico" data-nome="<?php echo e($muamba->nome); ?>" data-id="<?php echo e($muamba->id); ?>" data-token="<?php echo e(csrf_token()); ?>"><i class="glyphicon glyphicon-folder-open"></i></button>
                                                <?php endif; ?>

                                                <button class="btn btn-sm btn-danger deletar-muamba" style="margin-top: 3px;" data-toggle="tooltip" title="Excluir Muamba" data-id="<?php echo e($muamba->id); ?>" data-token="<?php echo e(csrf_token()); ?>"><i class="glyphicon glyphicon-trash"></i></button>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            <?php else: ?>
                                <tfoot>
                                    <tr>
                                        <td colspan="4">
                                            <div class="alert alert-warning" role="alert">
                                                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                                Nenhuma muamba encontrada
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            <?php endif; ?>
                        </table>
                        <div class="pull-right">
                            <?php echo e($muambas->links()); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-rastreio" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="titulo-modal"></h4>
                </div>
                <div class="modal-body" id="div-modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script type="text/javascript" src="<?php echo e(URL::asset('js/muambas/index.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>