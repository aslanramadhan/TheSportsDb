<?php
/**
 * @file
 * Contains \TheSportsDb\Entity\Proxy\SeasonProxy.
 */

namespace TheSportsDb\Entity\Proxy;

use TheSportsDb\Exception\TheSportsDbException;
use TheSportsDb\Entity\SeasonInterface;

/**
 * A sport object that is not yet fully loaded.
 *
 * @author Jelle Sebreghts
 */
class SeasonProxy extends Proxy implements SeasonInterface {

  /**
   * {@inheritdoc}
   */
  protected function load() {
    throw new TheSportsDbException('Could not fully load season with id ' . $this->getId() . ' and league id ' . $this->getLeague()->getId() . '.');
  }

  protected function loadEvents() {
    $event_data = $this->sportsDbClient->doRequest('eventsseason.php', array('id' => $this->getLeague()->getId(), 's' => $this->getId()));
    if (isset($event_data->events)) {
      $season = (object) array_merge((array) $this->factory->reverseMapProperties($this->properties), array('events' => $event_data->events));
      $this->entity = $this->factory->create($season);
      if ($this->entity instanceof SeasonInterface) {
        return;
      }
    }
    throw new TheSportsDbException('Could not fully load season with id ' . $this->getId() . ' and league id ' . $this->getLeague()->getId() . '.');
  }

  public function getId() {
    return $this->get('id');
  }

  public function getName() {
    return $this->get('name');
  }

  public function getEvents() {
    return $this->get('events');
  }

  public function getLeague() {
    return $this->get('league');
  }

}