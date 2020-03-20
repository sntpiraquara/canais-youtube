import { ValidationObserver, extend, localize } from "vee-validate";
import { required } from 'vee-validate/dist/rules';

extend('required', required);
extend('url', value => {
	const re = new RegExp(/https?:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&//=]*)/gi);
	return value.match(re);
});

import pt_BR from 'vee-validate/dist/locale/pt_br.json';

localize('pt_BR', pt_BR);
