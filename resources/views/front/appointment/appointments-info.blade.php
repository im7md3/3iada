@extends('front.layouts.front')
@section('title')
{{ __('Appointments')}}
@endsection
@section('content')
<style>
.table-color .bg-warning {
    background-color: #ffc107 !important;
}
</style>
<section id="app" class="table-color main-section py-5">
    <div class="container">
        <div class="section-content bg-white shadow p-4 rounded-3">
            <div class="row g-2 mb-3">
                <div class="col-12 d-flex align-items-center">
                    <div class="status d-flex align-items-end flex-wrap gap-1">
                        <div class="box d-flex ms-2 align-content-center align-items-center">
                            <div class="color one ms-1"></div>
                            <div class="text"><b>{{ __('Available') }}:</b> @{{dataFetch.availableTimes}}</div>
                        </div>
                        <div class="box d-flex ms-2 align-content-center align-items-center">
                            <div class="color two ms-1"></div>
                            <div class="text"><b>{{ __('Reserved') }}:</b>
                                @{{dataFetch.reservedAppointments}}
                            </div>
                        </div>
                        <div class="box d-flex ms-2 align-content-center align-items-center">
                            <div class="color three ms-1"></div>
                            <div class="text"><b>{{ __('Present') }}:</b>
                                @{{dataFetch.presentAppointments}} </div>
                        </div>
                        <div class="box d-flex ms-2 align-content-center align-items-center">
                            <div class="color six ms-1"></div>
                            <div class="text"><b>{{ __('Converters') }}:</b>
                                @{{dataFetch.convertersAppointments}}</div>
                        </div>
                        <div class="box d-flex ms-2 align-content-center align-items-center">
                            <div class="color five ms-1"></div>
                            <div class="text"><b> {{ __('Attended') }}:</b>
                                @{{dataFetch.attendedAppointments}}</div>
                        </div>
                        <div class="box d-flex align-content-center align-items-center">
                            <div class="color four ms-1"></div>
                            <div class="text"><b>{{ __('did not attend') }}:</b>
                                @{{dataFetch.cancelledAppointments}}</div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="d-flex flex-wrap flex-sm-nowrap align-items-center gap-4">
                        <div dir="ltr" class="input-group">
                            <select class="form-control" @change="updateData()" v-model="filters.department_id">
                                <option value="">{{ __('Choose department') }}</option>
                                <option :value="item.id" v-for="item in dataFetch.departments" :key="item.id">
                                    @{{item.name}}</option>
                            </select>
                            <span class="input-group-text" style="font-size: .8rem;"
                                id="basic-addon2">{{ __('Choose department') }}</span>
                        </div>
                        <div dir="ltr" class="input-group">
                            <select class="form-control" @change="updateData()" v-model="filters.doctor_id">
                                <option value="">{{ __('Choose doctor') }}</option>
                                <option :value="item.id" v-for="item in dataFetch.doctors" :key="item.id">@{{item.name}}
                                </option>
                            </select>
                            <span class="input-group-text" style="font-size: .8rem;"
                                id="basic-addon2">{{ __('Choose doctor') }}</span>
                        </div>
                        <div dir="ltr" class="input-group">
                            <input dir="rtl" type="date" @change="updateData()" class="form-control"
                                v-model="filters.from">
                            <span class="input-group-text" style="font-size: .8rem;"
                                id="basic-addon2">{{ __('from') }}</span>
                        </div>
                        <div dir="ltr" class="input-group">
                            <input dir="rtl" type="date" @change="updateData()" class="form-control"
                                v-model="filters.to">
                            <span class="input-group-text" style="font-size: .8rem;"
                                id="basic-addon2">{{ __('to') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <select name="" id="" class="form-control" @change="updateData()"
                        v-model="filters.appointment_duration">
                        <option value="" disabled selected>
                            {{ __('Choose Period') }}
                        </option>
                        <option value="morning">{{ __('morning') }}</option>
                        @if(setting()->evening_status)
                        <option value="evening">{{ __('evening') }}</option>
                        @endif
                    </select>
                </div>
            </div>



            <div class="row mb-3">
                <div class="col-12 col-lg-12">
                    <div class="table-responsive">
                        <table class="table main-table special-table">
                            <thead>
                                <tr>


                                    <th scope="col">
                                        <div class="top_word text-center"></div>
                                        <div class="bottom_word text-center"></div>
                                    </th>
                                    <th v-for="day in days" :key="day.date" scope="col">
                                        <div class="top_word text-center">
                                            @{{ day.name }}
                                        </div>
                                        <div class="bottom_word text-center text-center">
                                            @{{ day.date }}
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="time in formattedTimes" :key="time" class="fw-bolder">
                                    <td class="text-center text-black">
                                        <div class="top_word text-center">
                                            <bdi>
                                                @{{ formatTime(time) }}
                                            </bdi>
                                        </div>
                                        <div class="bottom_word text-center">
                                            <bdi>
                                                @{{ formatTime(addMinutes(time, 30)) }}
                                            </bdi>
                                        </div>
                                    </td>
                                    <td v-for="(day) in days" :key="day.date" scope="row">
                                        <div v-if="dataFetch.appointments.find(appointment => 
                                        appointment.appointment_date === day.date &&
                                        appointment.appointment_time === time
                                        )" class="text-center  bg-success" :class="{
                                        'bg-warning': dataFetch.appointments[getIndexAppointment(day.date, time)].appointment_status === 'pending',
                                        'bg-success': dataFetch.appointments[getIndexAppointment(day.date, time)].appointment_status === 'confirmed',
                                        'bg-danger': dataFetch.appointments[getIndexAppointment(day.date, time)].appointment_status === 'cancelled',
                                        'bg-dark': dataFetch.appointments[getIndexAppointment(day.date, time)].appointment_status === 'transferred',
                                        'bg-primary': dataFetch.appointments[getIndexAppointment(day.date, time)].appointment_status === 'examined'
                                        }"
                                    >
                                                                                    <p class="mb-0 text-white">
                                                @{{dataFetch.appointments[getIndexAppointment(day.date,time)].patient.first_name}}
                                            </p>
                                            <p class="mb-0 text-white">{{ __('Clinic') }}:
                                                @{{dataFetch.appointments[getIndexAppointment(day.date,time)].clinic.name}}
                                            </p>
                                            <p class="mb-0 text-white">{{ __('the Doctor') }}:
                                                @{{dataFetch.appointments[getIndexAppointment(day.date,time)].doctor.name}}<br>
                                            </p>
                                            <div class="toltip-table">
                                                <div class="holder-appointment d-flex flex-column gap-1">
                                                    <div
                                                        class="former-appointment bg-secondary rounded-1 p-1 text-center text-white d-flex flex-column">
                                                        <div class="info mb-2">
                                                            <small>{{ __('patient') }}:
                                                                @{{dataFetch.appointments[getIndexAppointment(day.date,time)].patient.first_name}}
                                                                |</small>
                                                            <small>{{ __('Clinic') }}:
                                                                @{{dataFetch.appointments[getIndexAppointment(day.date,time)].clinic.name}}
                                                                |</small>
                                                            <small>{{ __('the Doctor') }}:
                                                                @{{dataFetch.appointments[getIndexAppointment(day.date,time)].doctor.name}}</small>
                                                        </div>
                                                        <a :href="`/appointments/${dataFetch.appointments[getIndexAppointment(day.date, time)].patient_id}/edit`"
                                                            class="btn btn-sm btn-info w-100">تعديل <i
                                                                class="fa-solid fa-pen-to-square"></i></a>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                        <div v-else class="text-center">
                                            <div class="toltip-table">
                                                <div class="holder-appointment d-flex flex-column gap-1">
                                                    <a :href="`/appointments/create?appointment_duration=${filters.appointment_duration}&appointment_date=${day.date}&appointment_time=${time}`"
                                                        class="btn btn-sm btn-success w-100">
                                                        {{ __('Add') }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="{{ asset('js/vue.js') }}"></script>
<script>
const {
    createApp,
    ref,
    reactive,
    computed,
    onMounted
} = Vue

createApp({
    setup() {
        // Filter Data
        let filters = reactive({
            department_id: "",
            doctor_id: "",
            from: "",
            to: "",
            appointment_duration: "",
        })

        // Days
        let days = computed(() => {
            const startDate = filters.from ? new Date(filters.from) : new Date()
            startDate.setDate(startDate.getDate() - startDate.getDay())
            const countDays = filters.to ? Math.floor((new Date(filters.to) - startDate) / (1000 * 60 *
                60 * 24)) + 1 : 7
            return Array.from({
                length: countDays
            }, (_, i) => {
                const date = new Date(startDate)
                date.setDate(date.getDate() + i)
                const dayNames = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday',
                    'Friday', 'Saturday'
                ]
                return {
                    name: dayNames[date.getDay()],
                    date: date.toISOString().slice(0, 10)
                }
            })
        })

        // Time
        const formattedTimes = ref([]);
        const formatTime = (timeString) => {
            if (!timeString) return null;
            const [hoursInput, minutes] = timeString.split(':')
            let hours = parseInt(hoursInput, 10)
            if (isNaN(hours) || hours < 0 || hours > 23) return null;
            if (hours < 10) hours = '0' + hours
            const ampm = hours >= 12 ? 'PM' : 'AM'
            hours = hours % 12
            hours = hours ? hours : 12
            return hours + ':' + minutes + ' ' + ampm
        }
        const addMinutes = (timeString, minutes) => {
            if (!timeString) return null;
            let [hours, mins] = timeString.split(':')
            hours = parseInt(hours, 10)
            mins = parseInt(mins, 10)
            if (isNaN(hours) || hours < 0 || hours > 23 || isNaN(mins) || mins < 0 || mins > 59)
                return null;
            mins += minutes
            if (mins >= 60) {
                hours += 1
                mins -= 60
            }
            if (hours < 10) hours = '0' + hours
            if (mins < 10) mins = '0' + mins
            return hours + ':' + mins
        }

        // Fetch Data
        let dataFetch = ref([]);
        async function updateData() {
            try {
                const response = await fetch(
                    `/api/appointments-info?department_id=${filters.department_id}&doctor_id=${filters.doctor_id}&from=${filters.form}&to=${filters.to}&appointment_duration=${filters.appointment_duration}`
                );
                const data = await response.json();
                dataFetch.value = data.data;
                dataFetch.value.times.map(time => {
                    const [hour, minutes] = time.split(':');
                    const formattedHour = hour.length === 1 ? '0' + hour : hour;
                    formattedTimes.value.push(formattedHour + ':' + minutes);
                });
            } catch (error) {
                console.log(error);
            }
        }
        onMounted(() => {
            updateData();
        });
        // getIndexAppointment
        let getIndexAppointment = (day, time) => {
            if (dataFetch && dataFetch.value.appointments && dataFetch.value.appointments) {
                return dataFetch.value.appointments.indexOf(dataFetch.value.appointments.find(appointment =>
                    appointment.appointment_date === day && appointment.appointment_time === time));
            }
        }


        return {
            dataFetch,
            updateData,
            filters,
            days,
            formattedTimes,
            getIndexAppointment,
            formatTime,
            addMinutes,
        };
    }
}).mount('#app');
</script>

@endsection