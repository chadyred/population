<?php

/**
 * Archive form.
 *
 * @package    population
 * @subpackage form
 * @author     Flament Guillaume
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ArchiveForm extends BaseArchiveForm
{
  public function configure(){
       $range = range('2038', '1901');

       $widgetDate = $this->widgetSchema['dateNaissance'] =
               new sfWidgetFormJQueryDate(array('image'=>'/images/jquery-ui-images/calendar.gif',
                                                         'culture' => 'fr',
                                                         'date_widget' => new sfWidgetFormDate(array(
                                                            'format' => '%day%/%month%/%year%',
                                                            'years' => array_combine($range, $range))
                                                          )));

  }
}
