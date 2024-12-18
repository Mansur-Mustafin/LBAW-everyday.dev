import { sendAjaxRequest } from './utils.js'

const statsDiv = document.getElementById('statistics')
const baseUrl = statsDiv.dataset.url
// API Requests
const getStats = async () => {
let finalData;
  sendAjaxRequest(
    `${baseUrl}/api/stats`,
    (data) => {
      if(statsDiv) {
        statsDiv.innerHTML = `
                      <div class="bg-purple-700 flex flex-col shrink rounded p-1">
                          <p class="text-sm">Users</p>
                          <p class="text-4xl ">${data.users}</p>
                      </div>
                      <div class="bg-purple-700 flex flex-col shrink rounded p-1">
                          <p class="text-sm">Active Tags</p>
                          <p class="text-4xl">${data.tags}</p>
                      </div>
                      <div class="bg-purple-700 flex flex-col shrink rounded p-1">
                          <p class="text-sm">Tag Proposals</p>
                          <p class="text-4xl">${data.tag_proposals}</p>
                      </div>
                      <div class="bg-purple-700 flex flex-col shrink rounded p-1">
                          <p class="text-sm">Unblock Appeals</p>
                          <p class="text-4xl">${data.unblock_appeals}</p>
                      </div>
                      <div class="bg-purple-700 flex flex-col shrink rounded p-1">
                          <p class="text-sm">Omitted Posts</p>
                          <p class="text-4xl">${data.omitted_posts}</p>
                      </div>
                      <div class="bg-purple-700 flex flex-col shrink  rounded p-1">
                          <p class="text-sm">Omitted Comments</p>
                          <p class="text-4xl">${data.omitted_posts}</p>
                      </div>
        `
      }
    },
    'GET'
  )
  return finalData
}
getStats()
