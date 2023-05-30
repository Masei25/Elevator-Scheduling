<?php

class ElevatorController {
    private $elevators;
    
    function __construct($numElevators) {
        // Initialize elevators
        $this->elevators = array();
        for ($i = 0; $i < $numElevators; $i++) {
            $this->elevators[$i] = new Elevator();
        }
    }
    
    function requestElevator($destinationFloor) {
        // Find the nearest available elevator
        $nearestElevator = null;
        $minDistance = PHP_INT_MAX;
        
        foreach ($this->elevators as $elevator) {
            if ($elevator->isAvailable()) {
                $distance = abs($destinationFloor - $elevator->getCurrentFloor());
                if ($distance < $minDistance) {
                    $nearestElevator = $elevator;
                    $minDistance = $distance;
                }
            }
        }
        
        if ($nearestElevator != null) {
            $nearestElevator->assignDestination($destinationFloor);
            return $nearestElevator;
        }
        
        return null; // No available elevators
    }
    
    // Other methods for handling elevator movements, floor requests, etc.
}

class Elevator {
    private $currentFloor;
    private $destinationFloor;
    
    function __construct() {
        $this->currentFloor = 0; // Assuming ground floor as the initial position
        $this->destinationFloor = null;
    }
    
    function isAvailable() {
        return $this->destinationFloor === null;
    }
    
    function getCurrentFloor() {
        return $this->currentFloor;
    }
    
    function assignDestination($destinationFloor) {
        $this->destinationFloor = $destinationFloor;
    }
    
    // Other methods for elevator movement, reaching destination, etc.
}

// Example usage
$controller = new ElevatorController(4); // Create a controller with 4 elevators
$elevator = $controller->requestElevator(7); // Request an elevator to go to floor 7

if ($elevator != null) {
    echo "Elevator assigned. Current floor: " . $elevator->getCurrentFloor();
} else {
    echo "No available elevators at the moment.";
}
