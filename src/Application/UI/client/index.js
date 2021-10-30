import naja from 'naja';
import './analytics';
import './errorHandler';
import {categoryFilterExtension} from './categoryFilter';
import {SpinnerExtension} from './spinner';
import netteForms from 'nette-forms';

import './index.css';

naja.registerExtension(categoryFilterExtension);
naja.registerExtension(new SpinnerExtension('.mainContent'));
naja.formsHandler.netteForms = netteForms;
naja.initialize();
