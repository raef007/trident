<template>
	<v-app-bar>
        <template v-slot:prepend>
            <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
        </template>

        <v-app-bar-title>{{ title }}</v-app-bar-title>

        <v-spacer></v-spacer>

        <v-btn icon>
            <v-icon icon="mdi-magnify">mdi-magnify</v-icon>
        </v-btn>

        <v-btn icon>
            <a
            	class="dropdown-item"
                :href="window.baseURL+'/logout'"
                @click.prevent="handleLogout"
            >
                <v-icon>mdi-logout</v-icon>
            </a>

            <form id="logout-form" :action="window.baseURL+'/logout'" method="POST" class="d-none">
                <input type="hidden" name="_token" :value="csrf">
            </form>
        </v-btn>
    </v-app-bar>

    <v-navigation-drawer v-model="drawer">
        <v-list>
            <v-list-item class="left-nav-list">
                <a class="left-nav-item" :href="window.baseURL">
                    <v-icon class="left-nav-icon" icon="mdi-view-dashboard"></v-icon>
                    Dashboard
                </a>
            </v-list-item>
        </v-list>
    </v-navigation-drawer>
</template>

<script>
export default {
    props: ['title'],
    data: () => ({
    	drawer: false,
    	csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
	}),
	methods: {
		handleLogout: function() {
			document.getElementById('logout-form').submit();
		}
	}
}
</script>