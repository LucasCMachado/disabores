<div id="cadastrar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog"> 
        <div class="modal-content"> 
            <div class="modal-header"> 
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                <h4 class="modal-title">Cadastrar nova conta</h4> 
            </div>
            <form method='post' id='conta-EnviaForm' action="#" role="form"> 
                <div class="modal-body">
                    <div class="row"> 
                        <div class="col-md-12"> 
                            <div class="form-group"> 
                                <label for="nome" class="control-label">Nome *</label> 
                                <input type="text" class="form-control" name="nome" id="nome" placeholder="">
                                <input type="text" class="form-control" name="op" id="op" value="1" style="display: none;"> 
                            </div> 
                        </div>
                        <div class="col-md-12"> 
                            <div class="form-group"> 
                                <label for="valor" class="control-label">Valor *</label> 
                                <input type="text" class="form-control money" name="valor" id="valor" placeholder=""> 
                            </div> 
                        </div>

                        <div class="col-md-12"> 
                            <div class="form-group"> 
                                <label for="data_entrada" class="control-label">Data de entrada *</label> 
                                <input type="text" class="form-control date" name="data_entrada" id="data_entrada" placeholder=""> 
                            </div> 
                        </div>
                        <div class="col-md-12"> 
                            <div class="form-group"> 
                                <label for="data_vencimento" class="control-label">Data de vencimento *</label> 
                                <input type="text" class="form-control date" name="data_vencimento" id="data_vencimento" placeholder=""> 
                            </div> 
                        </div>
                        <div class="col-md-12"> 
                            <div class="form-group">
                                <label for="tipo" class="control-label">Tipo de conta *</label>
                                <select class="select2" id="tipo" name="tipo">
                                    <option value="1">Saída</option>
                                    <option value="0">Entrada</option>                                  
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12"> 
                            <div class="form-group">
                                <label for="id_fornecedor" class="control-label">Fornecedor *</label>
                                <select class="select2" id="id_fornecedor" name="id_fornecedor">
                                    <option value="#">&nbsp</option>
                                    <?php
                                        $stmt2 = $dbh->prepare('SELECT id, nome FROM fornecedor WHERE status=1 ORDER BY nome ASC');
                                        $stmt2->execute();

                                        foreach ($stmt2->fetchAll(PDO::FETCH_ASSOC) as $row2) {
                                            echo '<option value="'.$row2['id'].'">'.$row2['nome'].'</option>';
                                        }
                                    ?>                                                                      
                                </select>
                            </div>
                        </div> 
                    </div>
                </div> 
                <div class="modal-footer"> 
                    <button type="button" class="btn btn-white btn-rounded" data-dismiss="modal">Cancelar</button> 
                    <button type="submit" class="btn btn-success btn-rounded">Salvar</button> 
                </div>
            </form> 
        </div> 
    </div>
</div><!-- /.modal -->


<div id="pagar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog"> 
        <div class="modal-content"> 
            <div class="modal-header"> 
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                <h4 class="modal-title">Pagar conta</h4>
            </div>
            <form method='post' id='conta-pagaForm' action="#" role="form"> 
                <div class="modal-body">
                    <span>Deseja realizar o pagamento da conta - <b id="pagaConta"></b></span>
                    <div class="row"> 
                        <div class="col-md-12"> 
                            <div class="form-group"> 
                                <input type="text" class="form-control" name="op" id="op" value="3" style="display: none;"> 
                                <input type="text" class="form-control" name="id" id="pagaId" style="display: none;"> 
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="modal-footer"> 
                    <button type="button" class="btn btn-white btn-rounded" data-dismiss="modal">Não</button> 
                    <button type="submit" class="btn btn-success btn-rounded">Sim</button> 
                </div>
            </form> 
        </div> 
    </div>
</div><!-- /.modal -->

<div id="receber" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog"> 
        <div class="modal-content"> 
            <div class="modal-header"> 
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                <h4 class="modal-title">Receber conta</h4>
            </div>
            <form method='post' id='conta-recebeForm' action="#" role="form"> 
                <div class="modal-body">
                    <span>Deseja realizar o recebimento da conta - <b id="recebeConta"></b></span>
                    <div class="row"> 
                        <div class="col-md-12"> 
                            <div class="form-group"> 
                                <input type="text" class="form-control" name="op" id="op" value="3" style="display: none;"> 
                                <input type="text" class="form-control" name="id" id="recebeId" style="display: none;"> 
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="modal-footer"> 
                    <button type="button" class="btn btn-white btn-rounded" data-dismiss="modal">Não</button> 
                    <button type="submit" class="btn btn-success btn-rounded">Sim</button> 
                </div>
            </form> 
        </div> 
    </div>
</div><!-- /.modal -->

<div id="deletar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog"> 
        <div class="modal-content"> 
            <div class="modal-header"> 
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                <h4 class="modal-title">Deletar conta</h4>
            </div>
            <form method='post' id='conta-deletaForm' action="#" role="form"> 
                <div class="modal-body">
                    <span>Deseja excluir a conta - <b id="deletaConta"></b></span>
                    <div class="row"> 
                        <div class="col-md-12"> 
                            <div class="form-group"> 
                                <input type="text" class="form-control" name="op" id="op" value="4" style="display: none;"> 
                                <input type="text" class="form-control" name="id" id="deletaId" style="display: none;"> 
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="modal-footer"> 
                    <button type="button" class="btn btn-white btn-rounded" data-dismiss="modal">Não</button> 
                    <button type="submit" class="btn btn-success btn-rounded">Sim</button> 
                </div>
            </form> 
        </div> 
    </div>
</div><!-- /.modal -->