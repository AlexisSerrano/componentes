<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class involucradosSeeder extends Seeder
{
    public function run()
    {
        DB::table('involucrados')->insert([
            ['id'=>1,'nombre'=>'victima u ofendido','descripcion'=>'Aquella persona que recibe el daño o se ve afectada por el denunciado'],
            ['id'=>2,'nombre'=>'Investigado(QRR)','descripcion'=>'Aquella persona que es objeto de investigación por la autoridad sin conocer sus datos personales'],
            ['id'=>3,'nombre'=>'Investigado(Conocido)','descripcion'=>'Aquella persona que es objeto de una investigación, de la cual se conocen sus datos personales'],
            ['id'=>4,'nombre'=>'Investigado(Comparecencia)','descripcion'=>'Persona que es objeto de investigacion y que está presente al momento del registro'],
            ['id'=>5,'nombre'=>'Autoridad','descripcion'=>'Persona que tiene la facultdad de mandar a las personas que estén subordinadas'],
            ['id'=>6,'nombre'=>'Testigo','descripcion'=>'Persona que ha presenciado un hecho determinado y que puede dar un testimonio'],
            ['id'=>7,'nombre'=>'Abogado','descripcion'=>'Persona legalmente autorizada para asesorar y defender los derechos e intereses de otra persona'],
            ['id'=>8,'nombre'=>'Persona','descripcion'=>'Aquella persona que ocupa el mayor número de registros provenientes de la tabla persona'],
            ['id'=>9,'nombre'=>'Denunciante','descripcion'=>'Persona que interpone una denuncia'],
            ['id'=>10,'nombre'=>'Denunciado(QRR)','descripcion'=>'Presunto responsable de los hechos sin tener conocimiento de los datos personales'],
            ['id'=>11,'nombre'=>'Denunciado(Conocido)','descripcion'=>'Presunto responsable de los hechos, teniendo a la manos los datos personales'],
            ['id'=>12,'nombre'=>'Denunciado(Comparecencia)','descripcion'=>'Presunto responsable de los hechos y que está presente']            
        ]);
    }
}
