using System;
using System.Collections.Generic;
using System.Text;

namespace FROG.DotNet.SimpleSearch.Index
{
    // Just an abstraction for the local filesystem runtime functions.
    public class FileSystemIndex : IIndexService
    {
        public string PerformSearchAndGetHandle(string query)
        {
            var guid = Guid.NewGuid();
            return guid.ToString();
        }

        public List<SearchResult> GetSearchResults(string handle)
        {
            List<SearchResult> results = new List<SearchResult>();



            return results;
        }
    }
}
