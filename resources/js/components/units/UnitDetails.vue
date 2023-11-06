<template>
    <v-container v-if="!loading">
        <v-card>
            <v-toolbar color="info">
                <v-toolbar-title>
                    {{ unit.label }}
                </v-toolbar-title>

                <v-spacer></v-spacer>

                <v-btn icon>
                    <v-icon>mdi-cog-outline</v-icon>
                </v-btn>

                <template v-slot:extension>
                    <v-tabs
                        v-model="tab"
                        align-tabs="start"
                    >
                        <v-tab
                            value="Details"
                        >
                            Details
                        </v-tab>

                        <v-tab
                            value="Owner"
                        >
                            Owner
                        </v-tab>

                        <v-tab
                            value="Tenant"
                        >
                            Tenant
                        </v-tab>
                    </v-tabs>
                </template>
            </v-toolbar>

            <v-window v-model="tab">
                <v-window-item
                    value="Details"
                >
                    <v-card flat>
                        <v-card-text>
                            <small>
                                <span v-if="unit.address">{{ unit.address }}, </span>
                                <span v-if="unit.community.city">{{ unit.community.city }}, </span>
                                <span v-if="unit.community.state">{{ unit.community.state }}, </span>
                                <span v-if="unit.community.country">{{ unit.community.country }}</span>
                            </small>
                        </v-card-text>
                    </v-card>
                </v-window-item>

                <v-window-item
                    value="Owner"
                >
                    <v-card flat>
                        <v-card-text>
                            Owner Details
                        </v-card-text>
                    </v-card>
                </v-window-item>

                <v-window-item
                    value="Tenant"
                >
                    <v-card flat>
                        <v-card-text>
                            Tenant Details
                        </v-card-text>
                    </v-card>
                </v-window-item>
            </v-window>
        </v-card>

        <v-cols md="12">
            <h1>{{ unit.name }}</h1>
            
        </v-cols>

        <v-cols md="12">

        </v-cols>
    </v-container>
</template>

<script>
export default {
    props: ['unitid'],
    data: () => (
        {
            loading: true,
            unit: {},
            tab: null,
            text: "Hello World"
        }
    ),
    mounted() {
        this.fetchUnit();
    },
    computed: {

    },
    methods: {
        fetchUnit: function() {
            this.loading = true;

            axios.get(window.baseURL+'/api/units/'+this.unitid)
                .then(response => {
                    this.unit = response.data.resource;
                    this.loading = false;
                })
        },
    }
};
</script>