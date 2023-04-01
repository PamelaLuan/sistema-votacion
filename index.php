<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Votación</title>

    <link rel="stylesheet" href="./css/styles.css">
</head>
<body>

    <main>

        <h1>Formulario de Votación:</h1>

        <fieldset class="fieldset_content">

            <form action="">
                <div>
                    <label for="txtNombre">Nombre y Apellido</label>
                    <input type="text" id="txtNombre" name="txtNombre" required>
                    
                    <label for="txtAlias">Alias</label>
                    <input type="text" id="txtAlias" name="txtAlias" required>
    
                    <label for="txtRut">RUT</label>
                    <input type="text" id="txtRut" name="txtRut" required>
    
                    <label for="txtEmail">Email</label>
                    <input type="text" id="txtEmail" name="txtEmail" required>
    
                    <label for="region">Región</label>
                    <select name="region" id="region"></select>                
    
                    <label for="comuna">Comuna</label>
                    <select name="comuna" id="comuna" disabled></select>
    
                    <label for="candidato">Candidato</label>    
                    <select name="candidato" id="candidato"></select>                   
                        
                    <p>Como se enteró de Nosotros</p>   
                    <div class="checkbox">    
                        <input type="checkbox"   name="opciones" id="op1" value="Web"><label for="op1">Web</label>
                        <input type="checkbox"   name="opciones" id="op2" value="TV"><label for="op2">TV</label>  
                        <input type="checkbox"   name="opciones" id="op3" value="Redes Sociales"><label for="op3">Redes Sociales</label>  
                        <input type="checkbox"   name="opciones" id="op4" value="Amigo"><label for="op4">Amigo</label>    
                    </div>
                </div>
    
                <input type="submit" value="Votar" id="btnVotar">
            </form>
        </fieldset>

        <div id="mensaje"></div>

    </main>
    
    <script src="./js/main.js"></script>

    <script type="text/javascript">
        candidatos();
        regiones();
    </script>
</body>
</html>