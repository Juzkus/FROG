using System;
using System.Collections.Generic;
using System.IO;
using System.Text;

namespace FROG.DotNet.SimpleSearch
{
    public class FileSystemSearchService
    {
        public List<SearchResult> Search(List<SearchCriteria> searchCriteria)
        {
            List<SearchResult> results = new List<SearchResult>();
            List<string> searchDirs = new List<string>();
            string fileName = string.Empty;
            string fileType = string.Empty;
            SearchComparison cmp = SearchComparison.EQUAL;

            foreach (var criteria in searchCriteria)
            {
                switch (criteria.Property)
                {
                    case "fileName":
                        fileName = criteria.Value;
                        cmp = criteria.CompareType;
                        break;
                    case "fileType":
                        break;
                    default:
                        break;
                }
            }

            //////////////
            // TODO MOVE
            //////////////
            //////////////

            var searchFiles = Directory.GetFiles(@"C:\github.com\Juzkus\FROG\FROG.DotNet\FROG.DotNet.SimpleSearch");

            foreach (var searchFileName in searchFiles)
            {
                switch (cmp)
                {
                    case SearchComparison.CONTAINS:
                        if (searchFileName.Contains(fileName))
                        {
                            results.Add(new SearchResult { Title = searchFileName });
                        }
                        break;
                    default:
                        break;
                }
            }

            return results;
        }
    }
}
