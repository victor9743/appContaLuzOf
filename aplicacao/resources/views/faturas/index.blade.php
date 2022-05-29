@extends('layouts._layoutMestre')

@section('content')

    <h3>Teste</h3>
    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Cadastrar
  </button>
       
        <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">     
            
      
                <div style="position: absolute; top: 0; right: 0;">
                    @foreach ($errors->all() as $error)        
                            <div class="toast alert alert-danger alert-dismissible toast-header bg-danger text-light" role="alert" aria-live="assertive" aria-atomic="true">        
                                    teste
                                    <button type="button" class="btn-close" data-dismiss="toast" aria-label="Close" data-bs-dismiss="toast" style="height: 2px"> </button>  
                            </div>  
                    @endforeach
                </div>
         
        
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cadastro</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                <div class="modal-body row">
                    <div class="col-sm-6 ">
                        <h5>Area da Fatura</h5>
                        <div class="mb-3">
                            <label for="descricao" class="form-label">Descricão</label>
                            <input type="text" class="form-control" name="descricao" id="descricao" placeholder="Ex: Fatura referente ao mês de ...">
                        </div>
                        <div class="mb-3">
                            <label for="valorFatura" class="form-label">Valor da fatura</label>
                            <input type="number" class="form-control" name="valorFatura" id="valorFatura">                  
                        </div>
                        <div class="mb-3">
                            <label for="imgFatura" class="form-label">Imagem da Fatura</label>
                            <input type="file" class="form-control" name="imgFatura" id="imgFatura">
                    
                        </div>
                        <div class="mb-3">
                            <label for="vencimento" class="form-label">Data de Vencimento</label>
                            <input type="date" class="form-control" name="vencimento" id="vencimento">

                        </div>
                    </div>
                    <div class="col-sm-6">
                        <h5>Area do recibo</h5>
                        <div class="mb-3">
                            <label for="imgRecibo" class="form-label">Imagem do Recibo</label>
                            <input type="file" class="form-control" name="imgRecibo" id="imgRecibo">

                        </div>
                        <div class="mb-3">
                            <label for="dataPagamento" class="form-label">Data do Pagamento</label>
                            <input type="date" class="form-control" name="dataPagamento" id="dataPagamento">
                        </div>
                    </div>            
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="salvar">Salvar</button>
                </div>
            </div>
        </div>
        <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <script>
        
        $(document).ready(function(){
            $('.toast').toast('show');

            $('#salvar').click(function(){

                descricao = $("#descricao").val();
                valorFatura = $("#valorFatura").val();
                imgFatura = $("#imgFatura").val();
                vencimento = $("#vencimento").val();
                imgRecibo = $("#imgRecibo").val();
                dataPagamento = $("#dataPagamento").val();

                $.ajax({
                        type: "post",
                        url: '/fatura/salvar',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            descricao: descricao,
                            valorFatura: valorFatura,
                            imgFatura: imgFatura,
                            vencimento: vencimento,
                            imgRecibo: imgRecibo,
                            dataPagamento: dataPagamento
                        },
                        success: function(data) { 
                            console.log(data);
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            
                            var x =JSON.stringify(jqXHR.responseJSON.errors);
                            y = x.split(",");
                            console.log(jqXHR.responseJSON.errors);
                            var c = "<?= json_decode("+y+"); ?>";
                            console.log(c);
                                  
              
                                /*

                                
                                 
                                erros[0] = jqXHR.responseJSON.errors.descricao[0];
                                erros[1] = jqXHR.responseJSON.errors.valorFatura[0];
                                erros[2] = jqXHR.responseJSON.errors.imgFatura[0];
                                erros[3] = jqXHR.responseJSON.errors.vencimento[0];
                                /*var x =jqXHR.responseJSON.errors;
                                console.log(x.length);*/
                            
                    
                        }
                });

                function manerror (valor){
                    console.log(valor);
                }
            });
        });    
    </script>
        
@endsection





