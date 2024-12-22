import { sendAjaxRequest } from './utils.js';

const statsDiv = document.getElementById('statistics');
if (statsDiv) {
  const baseUrl = statsDiv.dataset.url;
  // API Requests
  const getStats = async () => {
    let finalData;
    sendAjaxRequest(
      `${baseUrl}/api/stats`,
      (data) => {
        if (statsDiv) {
          statsDiv.innerHTML = `
            <div class="bg-input flex flex-col rounded-lg p-3 w-40">
                <p class="text-sm">Users</p>
                <p class="text-3xl text-gray-400">${data.users}</p>
            </div>
            <div class="bg-input flex flex-col rounded-lg p-3 w-40">
                <p class="text-sm">Active Tags</p>
                <p class="text-3xl text-gray-400">${data.tags}</p>
            </div>
            <div class="bg-input flex flex-col rounded-lg p-3 w-40">
                <p class="text-sm">Tag Proposals</p>
                <p class="text-3xl text-gray-400">${data.tag_proposals}</p>
            </div>
            <div class="bg-input flex flex-col rounded-lg p-3 w-40">
                <p class="text-sm">Unblock Appeals</p>
                <p class="text-3xl text-gray-400">${data.unblock_appeals}</p>
            </div>
            <div class="bg-input flex flex-col rounded-lg p-3 w-40">
                <p class="text-sm">Hidden Posts</p>
                <p class="text-3xl text-gray-400">${data.omitted_posts}</p>
            </div>
            <div class="bg-input flex flex-col rounded-lg p-3 w-40">
                <p class="text-sm">Hidden Comments</p>
                <p class="text-3xl text-gray-400">${data.omitted_comments}</p>
            </div>
        `;
        }
      },
      'GET'
    );
    return finalData;
  };
  getStats();
}
