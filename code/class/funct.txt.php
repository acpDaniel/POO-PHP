<?php

// função 
function linhaObjeto($objeto) {
    $reflection = new ReflectionClass(get_class($objeto));
    $string = get_class($objeto);

    foreach ($reflection->getProperties() as $property) {
        $name = $property->getName();
        $value = $reflection->getProperty($name)->getValue($objeto);

        // Se for um array ele não imprime
        if (is_array($value)) {
            continue;
        }

        // Se for um paciente, ele imprime o cpf do responsavel
        if ($objeto instanceof Paciente && $value instanceof Cliente) {
            $cpf_responsavel = $objeto->getResponsavel()->getCpf();

            $string .= " \$cpf_responsavel($cpf_responsavel)";
            continue;
        }

        $string .= " $$name($value)";
    }
    return $string;
}

?>