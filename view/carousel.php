<?php
/**
 * Constructs the bootstap carousel to be add the to the event page.
 */
class Carousel
{
  private $body;
  function __construct($data)
  {
    if (count($data) > 0) {
      $this->body = '<div id="eventImages" class="carousel slide" data-ride="carousel">';
      $this->body .= '<ol class="carousel-indicators">';
      $this->body .= $this->makeOrderedList($data);
      $this->body .= '</ol>';
      $this->body .= '<div class="carousel-inner" role="listbox">';
      $this->body .= $this->carouselInner($data);
      $this->body .= '</div>';
      $this->body .= '<a class="carousel-control-prev" href="#eventImages" role="button" data-slide="prev">';
      $this->body .= '<span class="carousel-control-prev-icon" aria-hidden="true"></span>';
      $this->body .= '<span class="sr-only">Previous</span>';
      $this->body .= '</a>';
      $this->body .= '<a class="carousel-control-next" href="#eventImages" role="button" data-slide="next">';
      $this->body .= '<span class="carousel-control-next-icon" aria-hidden="true"></span>';
      $this->body .= '<span class="sr-only">Next</span>';
      $this->body .= '</a>';
      $this->body .= '</div>';
    }
  }

  /**
   * Makes the navigation icons for the images.
   */
  function makeOrderedList($data)
  {
    if (count($data) > 0) {
      $item = '<li data-target="#eventImages" data-slide-to="0" class="active"></li>';
      if (count($data) > 1) {
        for ($i=1; $i < count($data) ; $i++) {
          $item .= '<li data-target="#eventImages" data-slide-to="' . $i . '"></li>';
        }
      }
    }
    return $item;
  }

  /**
   * Adds the images to the carousel.
   */
  function carouselInner($data)
  {
    if (count($data) > 0) {
      $item = '<div class="carousel-item active"><img src="' . $data[0]["Name"] . '" alt="img1" class="img-thumbnail"/></div>';
      if (count($data) > 1) {
        for ($i=0; $i < (count($data)-1); $i = $i + 1) {
          $next_img = $i + 1;
          $item .= '<div class="carousel-item"><img src="' . $data[$next_img]["Name"] . '" alt="img' . $next_img . '" class="img-thumbnail"/></div>';
        }
      }
    }
    return $item;
  }

  /**
   * Returns the carousel.
   */
  function getBody()
  {
    return $this->body;
  }
}

?>
