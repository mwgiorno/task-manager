import './bootstrap';
import 'bootstrap';
import Tagify from '@yaireo/tagify'

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

var input = document.getElementById('searchTags');
new Tagify(input)

var editTagsInput = document.getElementById('editTags');
var tagify = new Tagify(editTagsInput);
