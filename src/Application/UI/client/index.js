import naja from 'naja';
import './analytics';
import './errorHandler';
import {categoryFilterExtension} from './categoryFilter';
import './forms';

import './index.css';

naja.registerExtension(categoryFilterExtension);
naja.initialize();
