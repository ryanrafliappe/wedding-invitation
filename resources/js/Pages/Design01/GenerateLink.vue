<script setup>
import { computed, ref } from 'vue';

const recipient = ref('');
const copied = ref(false);

const baseUrl = "https://fadli-dan-rika.uliyan.my.id";

const generatedLink = computed(() => {
    const query = encodeURIComponent(recipient.value.trim());
    return `${baseUrl}?to=${query}`;
})

function copyLink() {
    navigator.clipboard.writeText(generatedLink.value)
        .then(() => {
            copied.value = true;
            setTimeout(() => {
                copied.value = false;
            }, 2000);
        })
        .catch(err => {
            console.error('Failed to copy link:', err);
        });
}
</script>

<template>
    <div class="flex flex-col items-center justify-center min-h-screen p-4 bg-gray-100">
        <div class="w-full max-w-xl p-6 space-y-4 bg-white shadow-lg rounded-2xl">
            <h1 class="text-2xl font-bold text-gray-800">Generate Link Undangan</h1>

            <input
                v-model="recipient"
                type="text"
                placeholder="Masukkan nama tamu (cth. Ryan Rafli, ST & Pasangan)"
                class="w-full p-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
            />

            <p class="text-gray-700 break-words">
                <span class="font-semibold">Link:</span><br />
                <a :href="generatedLink" class="text-blue-600 underline" target="_blank">
                    {{ generatedLink }}
                </a>
            </p>

            <button
                @click="copyLink"
                class="w-full p-2 text-white transition bg-blue-600 rounded-xl hover:bg-blue-700">
                Salin Link
            </button>

            <p v-if="copied" class="text-sm text-green-600">Link disalin!</p>
        </div>
    </div>
</template>