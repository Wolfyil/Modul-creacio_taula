<?php

//Posarem la ruta de la carpeta del formulari, per el nom d'espai on treballem.
namespace Drupal\creacio_taula\Formulari;

//Utilitzarem les següents llibreries per poder realitzar la nostre tasca.
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Messenger\MessengerTrait;


//Crearem una classe per la creacio del formulari.
class CreacioTaulaFormulari extends FormBase {


    //Crearem una funcio per Obtenir el ID del nostre formulari.
    public function getFormId() {
        return 'crear_taula_simple_form';
      }
 


    //Crearem una funcio per la construccio del nostre Formulari.
    public function buildForm(array $form, FormStateInterface $form_state) {

        $form['Numero'] = [
            '#type' => 'number',
            '#title' => $this->t('Introdueix un Numero, per crear una taula amb files'),
        ];
        

        
        //Obtindrem el valor 'Numero' que nosaltres hem introduït quan ens demana un numero.
        //Crearem una variable per guardar el valor 'Numero'
        $Numero_de_Files = $form_state->getValue(['Numero']);

        $form_state->setValue(['Numero'], $Numero_de_Files);
        
        
 
        //Crearem una Taula i afegirem el encapçalament.
        $form['Taula'] = [
            '#type' => 'table',
            '#title' => 'La meva Taula',
            '#header' => array('Nom i Cognom'),
        ];
 


        //Utilitzarem un bucle for amb la variable que te el 'Numero' guardat.
        //D'aquesta manera crearem les files per la taula amb el numero que vam introduïr.
        //Es creara les files per cada encapçalament que hem posat.

        for ($i=1; $i<=$Numero_de_Files; $i++) {

            $form['Taula'][$i]['Nom i Cognom'] = [
                '#type' => 'textfield',
                '#title' => t('Nom i Cognom'),
                '#title_display' => 'invisible',
                '#default_value' => 'Nom i Cognom'.$i,
            ];  

        }
 
       
        //Crearem un boto de 'Crear Taula'.
        $form['submit'] = [
            '#type' => 'submit',
            '#value' => $this->t('Crear Taula'),
        ];
 
        return $form;
    }
 
    

    //Crearem una funcio per quan li donem al boto de "Crear Taula".
    public function submitForm(array &$form, FormStateInterface $form_state) {

        //Crearem una variable per obtenir els valors del formulari quan li donem al boto de "Crear Taula".
        $values = $form_state->getValues();

        //Cada vegada que li donem al boto de "Crear Taula", el formulari es reconstrueix en base al numero que nosaltres
        //posem per les files de la creacio taula
        $form_state->setRebuild();

        //Una vegada enviat el formulari ens sortira un missatge de que s'ha creat correctament.
        $this->messenger()->addMessage('La Taula ha sigut creada correctament');
    }
 
}