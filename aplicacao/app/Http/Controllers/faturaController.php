<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fatura;
use Illuminate\Support\Facades\Validator;

class faturaController extends Controller
{
    function index() {

    }

    function create() {

    }

    public function salvar(Request $request){

        $validator = $request->validate([
            'descricao' => 'required',
            'valorFatura' => 'required',
            'imgFatura' => 'required',
            'vencimento' => 'required'
        
        ]);
        if(!$validator) {
            $obj = new Fatura;
            $obj->descricao = $request->descricao;
            $obj->valorFatura = $request->valorFatura;
            $obj->imgFatura = $request->imgFatura;
            $obj->vencimento = $request->vencimento;
            $obj->imgRecibo = $request->imgRecibo;
            $obj->dataPagamento = $request->dataPagamento;
    
            if($request->hasFile('imgFatura') && $request->file('imgFatura')->isValid()) {
                    $requestImage = $request->imgFatura;
        
                    // atribuir a variavel a extensão do arquivo
                    $extension = $requestImage->extension();
        
                    // cria uma hash e concatena com o tempo atual
                    $imageName = md5($requestImage->getClientOriginalName().strtotime("now") . "." . $extension);
        
                    // mover o arquivo/imagem para o diretório
                    $request->imgFatura->move(public_path('img/faturas'), $imageName);
        
                    // salvar a url do arquivo/imagem no banco
                    $obj->imgFatura = $imageName;
            }
    
                if($request->hasFile('imgRecibo') && $request->file('imgRecibo')->isValid()) {
                    $requestImage = $request->imgRecibo;
    
                    // atribuir a variavel a extensão do arquivo
                    $extension = $requestImage->extension();
    
                    // cria uma hash e concatena com o tempo atual
                    $imageName = md5($requestImage->getClientOriginalName().strtotime("now") . "." . $extension);
    
                    // mover o arquivo/imagem para o diretório
                    $request->imgRecibo->move(public_path('img/recibos'), $imageName);
    
                    // salvar a url do arquivo/imagem no banco
                    $obj->imgRecibo = $imageName;
                }
            
    
            $obj->save();
    
            //return redirect("/")->with('msg','salvo');
            return true;

        } else {
            return $validator;
        }

    }

    function remover(){

    }
}
