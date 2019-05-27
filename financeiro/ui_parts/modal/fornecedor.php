<div id="cadastrar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog"> 
        <div class="modal-content"> 
            <div class="modal-header"> 
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                <h4 class="modal-title">Cadastrar fornecedor</h4> 
            </div>
            <form method='post' id='fornecedor-EnviaForm' action="#" role="form"> 
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
                                <label for="cnpj" class="control-label">CNPJ *</label> 
                                <input type="text" class="form-control cnpj" name="cnpj" id="cnpj" placeholder=""> 
                            </div> 
                        </div>

                        <div class="col-md-12"> 
                            <div class="form-group"> 
                                <label for="telefone" class="control-label">Telefone</label> 
                                <input type="text" class="form-control phone" name="telefone" id="telefone" placeholder=""> 
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

<div id="editar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog"> 
        <div class="modal-content"> 
            <div class="modal-header"> 
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                <h4 class="modal-title">Editar fornecedor</h4> 
            </div>
            <form method='post' id='fornecedor-EditarForm' action="#" role="form"> 
                <div class="modal-body">
                    <div class="row"> 
                        <div class="col-md-12"> 
                            <div class="form-group"> 
                                <label for="editaNome" class="control-label">Nome</label> 
                                <input type="text" class="form-control" name="nome" id="editaNome" placeholder="">
                                <input type="text" class="form-control" name="op" id="op" value="2" style="display: none;">
                                <input type="text" class="form-control" name="id" id="editaId" style="display: none;">
                            </div> 
                        </div>
                        <div class="col-md-12"> 
                            <div class="form-group"> 
                                <label for="editaCnpj" class="control-label">CNPJ</label> 
                                <input type="text" class="form-control cnpj" name="cnpj" id="editaCnpj" placeholder=""> 
                            </div> 
                        </div>

                        <div class="col-md-12"> 
                            <div class="form-group"> 
                                <label for="editaTelefone" class="control-label">Telefone</label> 
                                <input type="text" class="form-control phone" name="telefone" id="editaTelefone" placeholder=""> 
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

<div id="desativar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog"> 
        <div class="modal-content"> 
            <div class="modal-header"> 
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                <h4 class="modal-title">Desativar fornecedor</h4> 
            </div>
            <form method='post' id='fornecedor-DesativaForm' action="#" role="form"> 
                <div class="modal-body">
                    <span>Deseja desativar o fornecedor - <b id="desativaNome"></b></span>
                    <div class="row"> 
                        <div class="col-md-12"> 
                            <div class="form-group"> 
                                <input type="text" class="form-control" name="op" id="op" value="3" style="display: none;"> 
                                <input type="text" class="form-control" name="id" id="desativaId" style="display: none;"> 
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

<div id="reativar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog"> 
        <div class="modal-content"> 
            <div class="modal-header"> 
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                <h4 class="modal-title">Reativar fornecedor</h4> 
            </div>
            <form method='post' id='fornecedor-DesativaForm' action="#" role="form"> 
                <div class="modal-body">
                    <span>Deseja reativar o fornecedor - <b id="reativaNome"></b></span>
                    <div class="row"> 
                        <div class="col-md-12"> 
                            <div class="form-group"> 
                                <input type="text" class="form-control" name="op" id="op" value="4" style="display: none;"> 
                                <input type="text" class="form-control" name="id" id="reativaId" style="display: none;"> 
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