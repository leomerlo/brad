<?php
	class marker {
		var $marker = '';

		function place($tid,$markers){

			$trip = new trip();
			$trip->load($tid);

			$frmtd_markers = [];

			foreach($markers as $marker) {

				$this->marker = R::dispense('marker');
				$this->marker->loc = $marker->geo;
				$this->marker->m_order = $marker->order;

				$frmtd_markers[] = $this->marker;

			}

			$trip->trip->ownMarker = $frmtd_markers;

			R::store($trip->trip);

		}

		function load($mid){

			$marker = R::load('marker',$mid);

			$this->marker = $marker;			

		}

		function remove($mid){

			$marker = R::load('marker',$mid);

			$marker->trip_id = null;

			R::store($marker);

		}

		function clean(){

			R::exec( 'DELETE FROM marker WHERE trip_id IS NULL' );
			
		}

	}
?>