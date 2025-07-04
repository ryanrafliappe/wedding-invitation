<script setup>
import { ref } from 'vue';

const props = defineProps({
    messages: Array
})

const localMessages = ref([...props.messages ?? []]);

const name = ref('');
const message = ref('');
const feedbackMessage = ref('');
const feedbackSuccess = ref(false);
const submitting = ref(false);

const submitForm = async () => {
    if (!name.value.trim() || !message.value.trim()) {
        feedbackMessage.value = "Nama dan pesan tidak boleh kosong";
        feedbackSuccess.value = false;
        return;
    }

    submitting.value = true;
    feedbackMessage.value = '';

    try {
        const response = await fetch('/store', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                sender: name.value,
                message: message.value
            })
        })

        if (!response.ok) {
            const data = await response.json();
            throw new Error(data.message || 'Pesan gagal dikirim');
        }

        const newMessage = {
            sender: name.value, 
            message: message.value,
            timestamp: new Date().toISOString()
        }
        localMessages.value.unshift(newMessage);

        name.value = '';
        message.value = '';
        feedbackMessage.value = 'Pesan berhasil dikirim';
        feedbackSuccess.value = true;
    } catch (error) {
        feedbackMessage.value = error.message || 'Terjadi kesalahan';
        feedbackSuccess.value = false;
    } finally {
        submitting.value = false;
    }
}
</script>

<template>
    <div class="mb-6 mt-12 mx-8 h-screen">
        <h1 data-aos="fade-up" data-aos-duration="500" class="text-3xl font-main text-end text-emerald-600">Pesan</h1>

        <div data-aos="fade-up" data-aos-duration="500" data-aos-delay="500" id="form" class=" flex flex-col">
            <input
                type="text"
                v-model="name"
                class="w-full h-12 mt-6 bg-gray-50 p-2 border border-gray-200 active:border-emerald-900 focus:border-emerald-900 rounded-lg"
                placeholder="Masukkan nama kamu.." >
            <textarea
                v-model="message"
                class="w-full h-32 bg-gray-50 p-2 border border-gray-200 mt-2 active:border-emerald-900 focus:border-emerald-900 rounded-lg"
                id=""
                placeholder="masukkan pesan kamu di sini.."></textarea>

            <p v-if="feedbackMessage" :class="{'text-red-600': !feedbackSuccess, 'text-emerald-600': feedbackSuccess, 'text-sm italic text-end': true}" class="mt-2">
                {{ feedbackMessage }}
            </p>
    
            <button
                @click="submitForm"
                :disabled="submitting"
                class="mt-4 bg-emerald-900 text-white px-4 py-2 text-sm rounded-full hover:bg-emerald-700">
                {{ submitting ? 'Mengirim...' : 'Kirim Pesan' }}
            </button>
        </div>

        <div data-aos="fade-up" data-aos-duration="500" data-aos-delay="500" id="messages" class=" h-96 mt-8 bg-gray-50 rounded-lg overflow-y-scroll">
            <div v-if="localMessages.length > 0">
                <div v-for="(message, index) in localMessages" :key="index" class="p-4 mb-4 border-b border-gray-200">
                    <p class="text-sm text-gray-600">{{ message.sender }}</p>
                    <p class="text-gray-800 text-lg">{{ message.message }}</p>
                </div>
            </div>
            <div v-else class="flex items-center justify-center h-full">
                <p class="text-center text-gray-500 italic">Belum ada pesan yang tersedia.</p>
            </div>
        </div>
    </div>
</template>