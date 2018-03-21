<?php

class CC {
 
    // Table names
    const USERS = 'users';
    const PROJECTS = 'projects';
    const USERPROJECTS = 'userprojects';
    const USERTYPES = 'usertypes';
    const MAPS = 'maps';
    const MAPLAYERS = 'maplayers';
    const LAYERS = 'layers';
    const SOURCES = 'sources';
    const LAYERTYPES = 'layertypes';
    const STYLES = 'styles';
    const APPLICATION_SETTINGS = 'application_settings';
    const CUSTOMERS = 'customers';
    const LANGUAGES = 'languages';
    const TEXT = 'text_elements';
    const SYMBOLS = 'symbols';
    const LEGENDS = 'legends';
    const LEGENDITEMS = 'legenditems';
    const DATAPOINTS = 'datapoints';
    const DATA = 'data';
    const CMS_TABLES = 'cms_tables';
    const CMS_FIELDS = 'cms_fields';
    
    // Other constants
    const DEFAULT_LANGUAGE_ID = 'nl';
    const ACTION_LIST = 'list';
    const ACTION_EDIT = 'edit';
    const ACTION_NEW = 'new';
    const ACTION_DELETE = 'delete';
    
    const PATH_TO_SYMBOLS = 'symbols/';
    const PATH_TO_AVATARS = 'user_avatars/';
    const PATH_TO_THUMBNAILS = 'project_thumbnails/';
    const PATH_TO_FILES = '../data/';
    
    const STYLE_TEMPLATE = "// Replace this with your own script
(function() {
var rood = new ol.style.Style({image: new ol.style.Circle({radius: 8,fill: new ol.style.Fill({color: 'red'})})});
var oranje = new ol.style.Style({image: new ol.style.Circle({radius: 8,fill: new ol.style.Fill({color: 'orange'})})});
var groen = new ol.style.Style({image: new ol.style.Circle({radius: 8,fill: new ol.style.Fill({color: 'green'})})});

  return function(feature, resolution) {
    var score = Math.floor(feature.get('value'));
    switch (score) {
      case 1:
        return [rood];
        break;
      case 2:
        return [oranje];
        break;
      case 3:
        return [groen];
        break;
    }
    return [rood];
  };
})()";
}
