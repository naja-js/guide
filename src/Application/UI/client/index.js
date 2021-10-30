import naja from 'naja';
import './analytics';
import './errorHandler';
import {categoryFilterExtension} from './categoryFilter';
import {spinnerExtension} from './spinner';
import './forms';

import './index.css';

naja.registerExtension(categoryFilterExtension);
naja.registerExtension(spinnerExtension);
naja.initialize();
