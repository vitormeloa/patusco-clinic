import 'vuetify/styles';
import { createVuetify } from 'vuetify';
import { mdi } from 'vuetify/iconsets/mdi';

const vuetify = createVuetify({
    icons: {
        defaultSet: 'mdi',
        sets: {
            mdi,
        },
    },
});

export default vuetify;
