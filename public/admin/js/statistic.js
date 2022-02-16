"use strict";

$('#visitorMap').vectorMap(
    {
      map: 'world_en',
      backgroundColor: '#ffffff',
      borderColor: '#f2f2f2',
      borderOpacity: .8,
      borderWidth: 1,
      hoverColor: '#000',
      hoverOpacity: .8,
      color: '#ddd',
      normalizeFunction: 'linear',
      selectedRegions: false,
      showTooltip: true
    });