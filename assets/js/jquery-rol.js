(function(a){
    
    a.fn.extend({
        
        // Crea los dados con el resultado aleatorio de la tirada
        
        tirar_dados: function() {
            
            var cuatro = a("#4").val();
            var seis = a("#6").val();
            var ocho = a("#8").val();
            var diez = a("#10").val();
            var doce = a("#12").val();
            var veinte = a("#20").val();
            
            var resultado_chat = "Mi tirada es: ";
            
            a("#resultado > div").remove();
            
            if (isNaN(cuatro) || isNaN(seis) || isNaN(ocho) || isNaN(diez) || isNaN(doce) || isNaN(veinte))
            {
                alert("¡Eso no es un número humano!");
            }
            else
            {
                if (cuatro > 0 && cuatro != "")
                {
                    div = a("<div class='tipo-dado'><span>D4: </span></div>");
                    resultado_chat += "-D4 <i class='fa fa-arrow-right'></> ";
                    
                    for (i = 0; i < cuatro; i++)
                    {
                        res = (Math.floor(Math.random() * 4) + 1);
                        dado = "<div class='dado sombreado'>" + res + "</div>";
                        
                        resultado_chat += res + " ";
                        
                        div.append(dado);
                    }
                    
                    a("#resultado").append(div);
                }
                
                if (seis > 0 && seis != "")
                {
                    div = a("<div class='tipo-dado'><span>D6: </span></div>");
                    resultado_chat += "-D6 <i class='fa fa-arrow-right'></> ";
                    
                    for (i = 0; i < seis; i++)
                    {
                        res = (Math.floor(Math.random() * 6) + 1);
                        dado = "<div class='dado sombreado'>" + res + "</div>";
                        
                        resultado_chat += res + " ";
                        
                        div.append(dado);
                    }
                    
                    a("#resultado").append(div);
                }
                
                if (ocho > 0 && ocho != "")
                {
                    div = a("<div class='tipo-dado'><span>D8: </span></div>");
                    resultado_chat += "-D8 <i class='fa fa-arrow-right'></> ";
                    
                    for (i = 0; i < ocho; i++)
                    {
                        res = (Math.floor(Math.random() * 8) + 1);
                        dado = "<div class='dado sombreado'>" + res + "</div>";
                        
                        resultado_chat += res + " ";
                        
                        div.append(dado);
                    }
                    
                    a("#resultado").append(div);
                }
                
                if (diez > 0 && diez != "")
                {
                    div = a("<div class='tipo-dado'><span>D10: </span></div>");
                    resultado_chat += "-D10 <i class='fa fa-arrow-right'></> ";
                    
                    for (i = 0; i < diez; i++)
                    {
                        res = (Math.floor(Math.random() * 10) + 1);
                        dado = "<div class='dado sombreado'>" + res + "</div>";
                        
                        resultado_chat += res + " ";
                        
                        div.append(dado);
                    }
                    
                    a("#resultado").append(div);
                }
                
                if (doce > 0 && doce != "")
                {
                    div = a("<div class='tipo-dado'><span>D12: </span></div>");
                    resultado_chat += "-D12 <i class='fa fa-arrow-right'></> ";
                    
                    for (i = 0; i < doce; i++)
                    {
                        res = (Math.floor(Math.random() * 12) + 1);
                        dado = "<div class='dado sombreado'>" + res + "</div>";
                        
                        resultado_chat += res + " ";
                        
                        div.append(dado);
                    }
                    
                    a("#resultado").append(div);
                }
                
                if (veinte > 0 && veinte != "")
                {
                    div = a("<div class='tipo-dado'><span>D20: </span></div>");
                    resultado_chat += "-D20 <i class='fa fa-arrow-right'></> ";
                    
                    for (i = 0; i < veinte; i++)
                    {
                        res = (Math.floor(Math.random() * 20) + 1);
                        dado = "<div class='dado sombreado'>" + res + "</div>";
                        
                        resultado_chat += res + " ";
                        
                        div.append(dado);
                    }
                    
                    a("#resultado").append(div);
                }
                    a("#resultado").append("<span class='res-chat' style='display: none;'>" + resultado_chat + "</span>");
            }
            
            // MANDAMOS RESULTADO A CHAT
            
            // FIN ENVIO A CHAT
            
            return this;
            
        },
        
        
        
        // Crea el contenedor y elementos necesarios para introducir la cantidad de dados
        // y el resultado
        
        mostrar_mesa: function(padre) {
            
            padre = padre || "body";
            var dados = new Array(4, 6, 8, 10, 12, 20);
            
            mesa = a("<div id='mesa'></div>");
            
            for (var i = 0; i < dados.length; i++)
            {
                grupo = a("<div class='form-group'></div>");
                grupo.append("<label class='col-sm-2' for='" + dados[i] + "'>Dados de " + dados[i] + " caras: </label>");
                grupo.append("<div class='col-sm-4'><input class='form-control input-sm' type='number' id='" + dados[i] + "' /></div>");
                
                mesa.append(grupo);
                
                if (i % 2 != 0)
                {
                    mesa.append("<br />");
                }
            }
            
            mesa.append("<button class='btn btn-default' id='lanzar'>Lanzar dados</button>");
            
            resultado = "<div id='resultado'><h4>RESULTADOS:</h4></div>";
            mesa.append(resultado);
            
            a(padre).append(mesa);
            
            return this;
            
        },
        
    });
    
})(jQuery);
