<template>
    <v-container v-if="!loading">
        <v-card>
            <v-toolbar color="info">
                <v-toolbar-title>
                    {{ unit.label }}
                </v-toolbar-title>

                <v-spacer></v-spacer>

                 <v-btn icon>
                    <v-icon>mdi-pencil</v-icon>
                </v-btn>

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
                            Owners
                        </v-tab>

                        <v-tab
                            value="Tenant"
                        >
                            Tenants
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
                            <v-col cols="12" md="12">
                                <v-row>
                                    <v-col cols="12" md="12">
                                        <strong>Address: </strong>
                                        <span v-if="unit.address">{{ unit.address }}, </span>
                                        <span v-if="unit.community.city">{{ unit.community.city }}, </span>
                                        <span v-if="unit.community.state">{{ unit.community.state }}, </span>
                                        <span v-if="unit.community.country">{{ unit.community.country }}</span>
                                    </v-col>
                                    <v-col cols="6" md="6">
                                        <strong>Unit Type: </strong>Condominium
                                    </v-col>
                                    <v-col cols="6" md="6">
                                        <strong>Cost: </strong>27,000
                                    </v-col>

                                    <v-col cols="6" md="6">
                                        <strong>Lot Area: </strong>200sqm
                                    </v-col>
                                    <v-col cols="6" md="6">
                                        <strong>Floor Area: </strong>600sqm
                                    </v-col>
                                    <v-col cols="6" md="6">
                                        <strong>Number of Rooms: </strong>5
                                    </v-col>
                                    <v-col cols="6" md="6">
                                        <strong>Number of T&B: </strong>3
                                    </v-col>
                                    <v-col cols="6" md="6">
                                        <strong>Parking: </strong>2
                                    </v-col>
                                    <v-col cols="12" md="12">
                                        <strong>Description: </strong>
                                        <p>
                                            This is a very nice place
                                        </p>
                                    </v-col>
                                </v-row>
                            </v-col>

                            <v-col cols="12" md="12">
                                <v-divider></v-divider>
                                <v-row>
                                    <v-col cols="12" md="12">
                                        <h3>Settings</h3>
                                    </v-col>
                                    <v-col cols="6" md="6">
                                        <strong>Billing Day: </strong>27
                                        <small> Cut-off day of the Billing for each month</small>
                                    </v-col>

                                    <v-col cols="6" md="6">
                                        <strong>Interest rate: </strong>1.25%
                                        <small> Interest rate for unpaid balance</small>
                                    </v-col>
                                    <v-col cols="6" md="6">
                                        <strong>Billable to: </strong>Tenant
                                        <small> Who will receive Billing Statement?</small>
                                    </v-col>
                                    <v-col cols="6" md="6">
                                        <strong>Occupancy: </strong>For Rent // For Rent, For Lease, Occupied, For Sale
                                    </v-col>
                                </v-row>
                            </v-col>

                            <v-col cols="12" md="12">
                                <v-divider></v-divider>
                                <v-row>
                                    <v-col cols="12" md="12">
                                        <h3>Gallery</h3>
                                    </v-col>
                                    <v-col cols="12" md="12">
                                        <v-carousel>
                                            <v-carousel-item
                                                src="https://cdn.vuetifyjs.com/images/cards/docks.jpg"
                                                cover
                                            ></v-carousel-item>

                                            <v-carousel-item
                                                src="https://cdn.vuetifyjs.com/images/cards/hotel.jpg"
                                                cover
                                            ></v-carousel-item>

                                            <v-carousel-item
                                                src="https://cdn.vuetifyjs.com/images/cards/sunshine.jpg"
                                                cover
                                            ></v-carousel-item>
                                        </v-carousel>
                                    </v-col>
                                </v-row>
                            </v-col>
                        </v-card-text>
                    </v-card>
                </v-window-item>

                <v-window-item
                    value="Owner"
                >
                    <v-card flat>
                        <v-card-text>
                            <v-col cols="12" md="12">
                                <v-table>
                                    <thead>
                                        <tr>
                                            <th> Name </th>
                                            <th> Email </th>
                                            <th> Mobile </th>
                                            <th> Actions </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr
                                            v-for="item in unit.owners"
                                            :key="item.id"
                                        >
                                            <td>
                                                <span 
                                                    v-if="item.pivot.is_primary"
                                                > 
                                                    <v-icon color="yellow">mdi-star</v-icon>
                                                </span>
                                                {{ item.name }}
                                            </td>
                                            <td> {{ item.email }} </td>
                                            <td> {{ item.profile.contact_number }} </td>
                                            <td>
                                                <v-btn
                                                    variant="flat"
                                                    color="success"
                                                    class="ma-1"
                                                    icon="mdi-pencil"
                                                    size="x-small"
                                                    @click=""
                                                ></v-btn>
                                                <v-btn
                                                    v-if="!item.pivot.is_primary"
                                                    variant="flat"
                                                    color="yellow"
                                                    class="ma-1"
                                                    icon="mdi-star"
                                                    size="x-small"
                                                    @click=""
                                                ></v-btn>
                                            </td>
                                        </tr>
                                    </tbody>
                                </v-table>
                            </v-col>

                            <v-col cols="12" md="12">
                                <v-divider></v-divider>
                                Transactions
                            </v-col>
                        </v-card-text>
                    </v-card>
                </v-window-item>

                <v-window-item
                    value="Tenant"
                >
                    <v-card flat>
                        <v-card-text>
                            <v-col cols="12" md="12">
                                <v-table>
                                    <thead>
                                        <tr>
                                            <th> Name </th>
                                            <th> Email </th>
                                            <th> Mobile </th>
                                            <th> Actions </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr
                                            v-for="item in unit.tenants"
                                            :key="item.id"
                                        >
                                            <td>
                                                <span 
                                                    v-if="item.pivot.is_primary"
                                                > 
                                                    <v-icon color="yellow">mdi-star</v-icon>
                                                </span>
                                                {{ item.name }}
                                            </td>
                                            <td> {{ item.email }} </td>
                                            <td> {{ item.profile.contact_number }} </td>
                                            <td>
                                                <v-btn
                                                    variant="flat"
                                                    color="success"
                                                    class="ma-1"
                                                    icon="mdi-pencil"
                                                    size="x-small"
                                                    @click=""
                                                ></v-btn>
                                                <v-btn
                                                    v-if="!item.pivot.is_primary"
                                                    variant="flat"
                                                    color="yellow"
                                                    class="ma-1"
                                                    icon="mdi-star"
                                                    size="x-small"
                                                    @click=""
                                                ></v-btn>
                                            </td>
                                        </tr>
                                    </tbody>
                                </v-table>
                            </v-col>

                            <v-col cols="12" md="12">
                                <v-divider></v-divider>
                                Transactions
                            </v-col>
                        </v-card-text>
                    </v-card>
                </v-window-item>
            </v-window>
        </v-card>

        <v-container>
            <v-cols cols="12" md="12">
                <h3> Notes </h3>
            </v-cols>
            <v-cols class="mt-3" cols="12" md="12">
                <v-card
                    class="mt-5"
                    color="info"
                    theme="dark"
                >
                    <v-card-title>
                        User 1
                        <div class="float-right"><span class="tiny"> June 06, 2023 </span></div>
                    </v-card-title>
                    <v-card-subtitle>
                        
                    </v-card-subtitle>
                    <v-card-text>
                        
                        <v-col cols="12" md="12">
                            "This is a Note and I like it..."
                        </v-col>
                    </v-card-text>
                </v-card>
            </v-cols>
        </v-container>

    </v-container>
</template>

<script>
export default {
    props: ['unitid'],
    data: () => (
        {
            loading: true,
            unit: {
                owners: [],
                tenants: [],
            },
            tab: null,
            text: "Hello World"
        }
    ),
    mounted() {
        this.fetchUnit();
        //this.fetchTest();
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
        fetchTest: function() {
            axios.get(window.baseURL+'/api/units/test')
                .then(response => {
                    console.log(response.data);
                })
        },
    }
};
</script>